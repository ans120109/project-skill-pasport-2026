@php
    $nama    = $orang->nama ?? $orang->name ?? '-';
    $jabatan = $orang->jabatan ?? $orang->mapel ?? $orang->mata_pelajaran ?? ucfirst($orang->role ?? '');
    $foto    = $orang->foto ?? null;

    $kata    = preg_split('/\s+/', trim(preg_replace('/^(Drs?\.|Dra\.|Hj?\.)\s*/i', '', $nama)));
    $inisial = mb_strtoupper(mb_substr($kata[0] ?? '', 0, 1) . mb_substr($kata[1] ?? '', 0, 1));
@endphp

<div class="card orang">
    @if($foto)
        <img src="{{ asset('storage/' . $foto) }}" alt="{{ $nama }}" class="orang-foto">
    @else
        <div class="orang-foto orang-inisial" aria-hidden="true">{{ $inisial }}</div>
    @endif
    <h4>{{ $nama }}</h4>
    <p>{{ $jabatan }}</p>
</div>