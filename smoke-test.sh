#!/usr/bin/env bash

set -u

PROJ="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$PROJ" || exit 1

PORT="${PORT:-8199}"
JAR="$(mktemp)"
BODY="$(mktemp)"
SERVERLOG="$(mktemp)"
PASS=0
FAIL=0

env_get() { grep -E "^$1=" .env | head -1 | cut -d= -f2- | tr -d '"' | tr -d "'"; }

DB_HOST="$(env_get DB_HOST)";     DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="$(env_get DB_PORT)";     DB_PORT="${DB_PORT:-3306}"
DB_USER="$(env_get DB_USERNAME)"; DB_USER="${DB_USER:-root}"
DB_PASS="$(env_get DB_PASSWORD)"; DB_PASS="${DB_PASS:-}"
DB_REAL="$(env_get DB_DATABASE)"
DB_TEST="${DB_REAL}_test"

if [ -z "$DB_REAL" ] || [ "$DB_TEST" = "$DB_REAL" ]; then
  echo "GAGAL: tidak bisa menentukan nama database uji dari .env" >&2
  exit 1
fi

cleanup() {
  [ -n "${SERVER_PID:-}" ] && kill "$SERVER_PID" 2>/dev/null
  pkill -f "artisan serve --port=$PORT" 2>/dev/null
  php -r "\$p=new PDO('mysql:host=$DB_HOST;port=$DB_PORT','$DB_USER','$DB_PASS'); \$p->exec('DROP DATABASE IF EXISTS \`$DB_TEST\`');" 2>/dev/null
  rm -f "$JAR" "$BODY" "$SERVERLOG"
}
trap cleanup EXIT

echo "Menyiapkan database uji: $DB_TEST"
php -r "\$p=new PDO('mysql:host=$DB_HOST;port=$DB_PORT','$DB_USER','$DB_PASS'); \$p->exec('DROP DATABASE IF EXISTS \`$DB_TEST\`'); \$p->exec('CREATE DATABASE \`$DB_TEST\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');" || { echo "GAGAL membuat database uji" >&2; exit 1; }

export DB_DATABASE="$DB_TEST"

php artisan migrate:fresh --seed --force >/dev/null 2>&1 || { echo "GAGAL menjalankan migrasi" >&2; exit 1; }
php artisan db:seed --class=UserSeeder --force >/dev/null 2>&1

php artisan tinker --execute="
App\Models\User::updateOrCreate(['username'=>'__nonaktif__'], ['name'=>'Akun Nonaktif','password'=>'rahasia123','role'=>'siswa','status'=>'nonaktif']);
App\Models\User::where('username','admin')->update(['last_active_at'=>null]);
" >/dev/null 2>&1

php artisan view:clear  >/dev/null 2>&1
php artisan config:clear >/dev/null 2>&1
php artisan route:clear  >/dev/null 2>&1

echo "Menjalankan server di port $PORT..."
php artisan serve --port="$PORT" >"$SERVERLOG" 2>&1 &
SERVER_PID=$!

for _ in $(seq 1 30); do
  curl -s -o /dev/null "http://127.0.0.1:$PORT/up" && break
  sleep 1
done

BASE="http://127.0.0.1:$PORT"

dbq() { php artisan tinker --execute="$1" 2>/dev/null | tail -1; }

get_token() {
  curl -s -b "$JAR" -c "$JAR" "$BASE$1" \
    | grep -oE 'name="_token"[^>]*value="[^"]+"' | head -1 | sed -E 's/.*value="//; s/"$//'
}

ok()   { echo "  [ OK ] $1"; PASS=$((PASS+1)); }
bad()  { echo "  [FAIL] $1"; FAIL=$((FAIL+1)); }

check_get() {
  local c
  c=$(curl -s -b "$JAR" -o "$BODY" -w "%{http_code}" "$BASE$1")
  if [ "$c" = "200" ]; then ok "GET $1"; else bad "GET $1 -> HTTP $c"; fi
}

req() {
  local label="$1" method="$2" path="$3"; shift 3
  local args=()
  for kv in "$@"; do args+=(--data-urlencode "$kv"); done
  local c
  c=$(curl -s -b "$JAR" -c "$JAR" -o "$BODY" -w "%{http_code}" -X "$method" "$BASE$path" "${args[@]}")
  case "$c" in
    2*|3*) ok "$label (HTTP $c)" ;;
    *)     bad "$label -> HTTP $c" ;;
  esac
}

login_expect() {
  rm -f "$JAR"
  local t; t=$(get_token /login)
  curl -s -b "$JAR" -c "$JAR" -o /dev/null -X POST "$BASE/login" \
    --data-urlencode "_token=$t" --data-urlencode "username=$1" --data-urlencode "password=$2"
  curl -s -b "$JAR" -c "$JAR" -o "$BODY" "$BASE/login"
  grep -q "$3" "$BODY"
}

echo ""
echo "=== 1. LOGIN ADMIN ==="
rm -f "$JAR"
T=$(get_token /login)
req "login babeh12" POST /login "_token=$T" "username=babeh12" "password=12345678"

NAMA_LOGIN=$(dbq "echo App\Models\User::where('username','babeh12')->value('name');")
ID_LOGIN=$(dbq "echo App\Models\User::where('username','babeh12')->value('id');")
if [ -n "$NAMA_LOGIN" ] && [ -n "$ID_LOGIN" ]; then
  ok "akun uji ditemukan: $NAMA_LOGIN (id=$ID_LOGIN)"
else
  bad "akun uji babeh12 tidak ada di database uji"
fi

echo "=== 2. SEMUA HALAMAN BISA DIBUKA ==="
for p in / /profile /profile-sekolah /berita /berita/tambah /ekstrakurikuler \
         /ekstrakurikuler-create /admin/users /admin/users/create /siswa-guru; do
  check_get "$p"
done

echo "=== 3. BERITA: simpan / tampil / edit / ubah / hapus ==="
curl -s -b "$JAR" -o "$BODY" "$BASE/berita/tambah"
if grep -q "Data penginput" "$BODY" && grep -qF "$NAMA_LOGIN" "$BODY"; then
  ok "form tambah menampilkan siapa penginputnya ($NAMA_LOGIN)"
else
  bad "form tambah TIDAK menampilkan nama penginput"
fi

T=$(get_token /berita/tambah)
req "simpan berita" POST /berita "_token=$T" "judul=Uji Coba Berita" "jenis=Berita" "tanggal=2026-09-29" "isi=Isi berita untuk pengujian."
BID=$(dbq "echo App\Models\Berita::where('judul','Uji Coba Berita')->value('id');")
if [ -n "$BID" ]; then
  ID_PENULIS=$(dbq "echo App\Models\Berita::find($BID)->id_user;")
  if [ "$ID_PENULIS" = "$ID_LOGIN" ]; then
    ok "penulis tercatat otomatis di database (id_user=$ID_PENULIS)"
  else
    bad "penulis TIDAK tercatat (id_user='$ID_PENULIS', diharapkan '$ID_LOGIN')"
  fi

  curl -s -b "$JAR" -o "$BODY" "$BASE/berita"
  if grep -q "Uji Coba Berita" "$BODY"; then ok "berita muncul di daftar /berita"; else bad "berita TIDAK muncul di daftar /berita"; fi
  if grep -q "Diinput oleh" "$BODY" && grep -qF "$NAMA_LOGIN" "$BODY"; then
    ok "daftar berita menampilkan penginput dan tanggal input"
  else
    bad "daftar berita TIDAK menampilkan penginput"
  fi

  check_get "/berita/$BID/edit"
  if grep -q "Riwayat input" "$BODY" && grep -qF "$NAMA_LOGIN" "$BODY"; then
    ok "halaman edit menampilkan riwayat input"
  else
    bad "halaman edit TIDAK menampilkan riwayat input"
  fi

  T=$(get_token "/berita/$BID/edit")
  req "ubah berita" PUT "/berita/$BID" "_token=$T" "judul=Judul Sudah Diedit" "jenis=Pengumuman" "tanggal=2026-09-30" "isi=Isi diperbarui."

  ID_PENULIS2=$(dbq "echo App\Models\Berita::find($BID)->id_user;")
  if [ "$ID_PENULIS2" = "$ID_LOGIN" ]; then
    ok "penulis tidak berubah setelah berita diedit"
  else
    bad "penulis berubah setelah diedit (jadi '$ID_PENULIS2')"
  fi

  req "hapus berita" DELETE "/berita/$BID" "_token=$T"
else
  bad "berita tidak tersimpan ke database"
fi

echo "=== 4. EKSTRAKURIKULER: simpan / detail / ubah / hapus ==="
T=$(get_token /ekstrakurikuler-create)
req "simpan ekstrakurikuler" POST /ekstrakurikuler "_token=$T" "nama=Pramuka Uji" "deskripsi=Deskripsi uji coba." "jadwal=Sabtu, 08.00-10.00"
EID=$(dbq "echo App\Models\Ekstrakurikuler::where('nama','Pramuka Uji')->value('id_ekstrakurikuler');")
if [ -n "$EID" ]; then
  check_get "/ekstrakurikuler/$EID"
  check_get "/ekstrakurikuler/$EID/edit"
  T=$(get_token "/ekstrakurikuler/$EID/edit")
  req "ubah ekstrakurikuler" PUT "/ekstrakurikuler/$EID" "_token=$T" "nama=Pramuka Uji Edit" "deskripsi=Deskripsi diperbarui." "jadwal=Ahad, 07.00-09.00"
  req "hapus ekstrakurikuler" DELETE "/ekstrakurikuler/$EID" "_token=$T"
else
  bad "ekstrakurikuler tidak tersimpan ke database"
fi

echo "=== 5. DATA SISWA: simpan / ubah / hapus ==="
T=$(get_token /siswa-guru)
req "simpan 2 siswa" POST /siswa-guru "_token=$T" "simpan=siswa" \
  "siswa[0][nama]=Siswa Uji A" "siswa[0][nis]=NIS-UJI-001" "siswa[0][kelas]=XII RPL 1" "siswa[0][jenis_kelamin]=L" \
  "siswa[1][nama]=Siswa Uji B" "siswa[1][nis]=NIS-UJI-002" "siswa[1][kelas]=XII RPL 2" "siswa[1][jenis_kelamin]=P"
SID=$(dbq "echo App\Models\Siswa::where('nis','NIS-UJI-001')->value('id');")
if [ -n "$SID" ]; then
  check_get "/siswa-guru/siswa/$SID/edit"
  T=$(get_token "/siswa-guru/siswa/$SID/edit")
  req "ubah siswa" PUT "/siswa-guru/siswa/$SID" "_token=$T" "nama=Siswa Uji A Edit" "nis=NIS-UJI-001" "kelas=XII RPL 3" "jenis_kelamin=L"
  req "hapus siswa" DELETE "/siswa-guru/siswa/$SID" "_token=$T"
else
  bad "siswa tidak tersimpan ke database"
fi

echo "=== 6. DATA GURU: simpan / ubah / hapus ==="
T=$(get_token /siswa-guru)
req "simpan guru" POST /siswa-guru "_token=$T" "simpan=guru" \
  "guru[0][nama]=Guru Uji" "guru[0][nip]=NIP-UJI-001" "guru[0][mata_pelajaran]=Matematika" "guru[0][no_hp]=081234567890"
GID=$(dbq "echo App\Models\Guru::where('nip','NIP-UJI-001')->value('id');")
if [ -n "$GID" ]; then
  check_get "/siswa-guru/guru/$GID/edit"
  T=$(get_token "/siswa-guru/guru/$GID/edit")
  req "ubah guru" PUT "/siswa-guru/guru/$GID" "_token=$T" "nama=Guru Uji Edit" "nip=NIP-UJI-001" "mata_pelajaran=Fisika" "no_hp=081299999999"
  req "hapus guru" DELETE "/siswa-guru/guru/$GID" "_token=$T"
else
  bad "guru tidak tersimpan ke database"
fi

echo "=== 7. ADMIN DATA USER: detail / simpan / ubah / hapus ==="
check_get "/admin/users/1"
check_get "/admin/users/1/edit"
T=$(get_token /admin/users/create)
req "simpan user baru" POST /admin/users "_token=$T" "name=User Uji" "username=useruji" "role=operator" "status=aktif" "password=rahasia123" "password_confirmation=rahasia123"
NEWUID=$(dbq "echo App\Models\User::where('username','useruji')->value('id');")
if [ -n "$NEWUID" ]; then
  T=$(get_token "/admin/users/$NEWUID/edit")
  req "ubah user" PUT "/admin/users/$NEWUID" "_token=$T" "name=User Uji Edit" "username=useruji" "role=operator" "status=aktif"
  req "coba hapus user AKTIF (harus ditolak)" DELETE "/admin/users/$NEWUID" "_token=$T"
  req "set user jadi nonaktif" PUT "/admin/users/$NEWUID" "_token=$T" "name=User Uji Edit" "username=useruji" "role=operator" "status=nonaktif"
  req "hapus user NONAKTIF" DELETE "/admin/users/$NEWUID" "_token=$T"
  if [ "$(dbq "echo App\Models\User::where('username','useruji')->count();")" = "0" ]; then
    ok "user nonaktif benar-benar terhapus"
  else
    bad "user nonaktif masih ada di database"
  fi
else
  bad "user baru tidak tersimpan ke database"
fi

echo "=== 8. VALIDASI FORM ==="
T=$(get_token /berita/tambah)
curl -s -b "$JAR" -o "$BODY" -X POST "$BASE/berita" \
  --data-urlencode "_token=$T" --data-urlencode "judul=Uji" --data-urlencode "jenis=berita" \
  --data-urlencode "tanggal=2026-09-29" --data-urlencode "isi=x"
if grep -q "Redirecting to $BASE/berita/tambah" "$BODY"; then ok "jenis tidak valid ditolak dan dikembalikan ke form"
else bad "jenis tidak valid seharusnya ditolak"; fi

echo "=== 9. LOGOUT & PROTEKSI HALAMAN ==="
T=$(get_token /profile)
req "logout" POST /logout "_token=$T"
c=$(curl -s -b "$JAR" -o /dev/null -w "%{http_code}" "$BASE/admin/users")
if [ "$c" = "302" ]; then ok "/admin/users butuh login (302)"; else bad "/admin/users seharusnya butuh login, dapat $c"; fi

echo "=== 10. REGISTER ==="
rm -f "$JAR"
T=$(get_token /register)
req "register siswa baru" POST /register "_token=$T" "name=Pendaftar Uji" "username=pendaftar_uji" "role=siswa" "password=rahasia123" "password_confirmation=rahasia123"
if [ "$(dbq "echo App\Models\User::where('username','pendaftar_uji')->count();")" = "1" ]; then ok "user hasil register tersimpan"; else bad "user hasil register tidak tersimpan"; fi

echo "=== 11. ATURAN LOGIN ==="
if login_expect "__nonaktif__" "rahasia123" "Akun Anda tidak aktif"; then ok "akun nonaktif ditolak"; else bad "akun nonaktif seharusnya ditolak"; fi
if login_expect "babeh12" "salah-total" "Username atau password salah"; then ok "password salah ditolak"; else bad "password salah seharusnya ditolak"; fi
rm -f "$JAR"
T=$(get_token /login)
curl -s -b "$JAR" -c "$JAR" -o /dev/null -X POST "$BASE/login" --data-urlencode "_token=$T" --data-urlencode "username=admin" --data-urlencode "password=password"
c=$(curl -s -b "$JAR" -c "$JAR" -o /dev/null -w "%{http_code}" "$BASE/admin/users")
if [ "$c" = "200" ]; then ok "akun aktif bisa login dan membuka /admin/users"; else bad "akun aktif gagal login (HTTP $c)"; fi

echo "=== 12. MIDDLEWARE UpdateLastActive ==="
LA=$(dbq "echo optional(App\Models\User::where('username','admin')->first())->last_active_at;")
if [ -n "$LA" ]; then ok "last_active_at tercatat: $LA"; else bad "last_active_at tidak tercatat"; fi

echo "=== 13. SISA DATA UJI ==="
SISA=$(dbq "echo App\Models\Siswa::where('nis','NIS-UJI-001')->count() + App\Models\Guru::where('nip','NIP-UJI-001')->count() + App\Models\Berita::where('judul','like','%Uji%')->count() + App\Models\Ekstrakurikuler::where('nama','like','Pramuka Uji%')->count() + App\Models\User::where('username','useruji')->count();")
if [ "$SISA" = "0" ]; then ok "semua data uji terhapus bersih"; else bad "masih ada $SISA data uji tersisa"; fi

echo ""
echo "=================================="
echo " LULUS: $PASS    GAGAL: $FAIL"
echo "=================================="

[ "$FAIL" -eq 0 ]
