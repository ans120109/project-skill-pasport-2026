<section id="guru" class="section">
    <div class="container">
        <div class="section-head">
            <h2>Daftar Guru</h2>
        </div>

        @if($gurus->isNotEmpty())
            <div class="grid-orang">
                @foreach($gurus as $orang)
                    @include('partials.kartu-orang', ['orang' => $orang])
                @endforeach
            </div>
        @else
            <div class="card muted">Data guru belum tersedia.</div>
        @endif
    </div>
</section>


<section id="staff" class="section">
    <div class="container">
        <div class="section-head">
            <h2>Daftar Staff</h2>
        </div>

        @if($staffs->isNotEmpty())
            <div class="grid-orang">
                @foreach($staffs as $orang)
                    @include('partials.kartu-orang', ['orang' => $orang])
                @endforeach
            </div>
        @else
            <div class="card muted">Data staff belum tersedia.</div>
        @endif
    </div>
</section>