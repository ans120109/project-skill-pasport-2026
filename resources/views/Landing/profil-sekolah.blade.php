<section id="profil" class="section">
    <div class="container">
        <div class="section-head">
            <h2>Profil Sekolah</h2>
        </div>

        @if($profil)
            <div class="card profil">
                @if(!empty($profil->foto))
                    <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto sekolah" class="profil-foto">
                @endif

                <div>
                    <h3>{{ $profil->nama_sekolah ?? $profil->nama ?? 'SMA Cendikia Nusantara' }}</h3>

                    @if(!empty($profil->deskripsi))
                        <p class="prose">{{ $profil->deskripsi }}</p>
                    @endif

                    @if(!empty($profil->alamat))
                        <p class="muted" style="margin-top:.5rem">{{ $profil->alamat }}</p>
                    @endif
                </div>
            </div>

            @if(!empty($profil->visi) || !empty($profil->misi))
                <div class="stack">

                    @if(!empty($profil->visi))
                        <div class="card">
                            <h3>Visi</h3>
                            <p class="prose">{{ trim($profil->visi) }}</p>
                        </div>
                    @endif

                    @if(!empty($profil->misi))
                        @php
                            $reNomor = '/^\d+[\.\)]\s*/';

                            $baris = collect(preg_split('/\r\n|\r|\n/', $profil->misi))
                                ->map(fn ($l) => trim($l))
                                ->filter()
                                ->values();

                            $adaNomor = $baris->contains(fn ($l) => preg_match($reNomor, $l));

                            $intro = $adaNomor
                                ? $baris->takeUntil(fn ($l) => preg_match($reNomor, $l))
                                : collect();

                            $butir = $baris->slice($intro->count())
                                ->map(fn ($l) => trim(preg_replace($reNomor, '', $l)))
                                ->filter()
                                ->values();
                        @endphp

                        <div class="card">
                            <h3>Misi</h3>

                            @foreach($intro as $kalimat)
                                <p class="prose" style="margin-bottom:.6rem">{{ $kalimat }}</p>
                            @endforeach

                            <ol class="list prose">
                                @foreach($butir as $b)
                                    <li>{{ $b }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif

                </div>
            @endif
        @else
            <div class="card muted">
                Data profil sekolah belum diisi. Isi melalui menu Profil Sekolah di dashboard admin.
            </div>
        @endif
    </div>
</section>