<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 50)->nullable();
            $table->string('email')->nullable();
            $table->longText('sejarah')->nullable();
            $table->longText('tentang')->nullable();
            $table->longText('tujuan')->nullable();
            $table->string('npsn', 20)->nullable();
            $table->string('akreditasi', 10)->nullable();
            $table->string('tahun_berdiri', 10)->nullable();
            $table->string('nama_kepsek')->nullable();
            $table->longText('sambutan')->nullable();
            $table->unsignedInteger('jumlah_siswa')->nullable();
            $table->unsignedInteger('jumlah_guru')->nullable();
            $table->unsignedInteger('jumlah_ekskul')->nullable();
            $table->longText('fasilitas')->nullable();
            $table->longText('prestasi')->nullable();
            $table->text('maps_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_sekolah');
    }
};