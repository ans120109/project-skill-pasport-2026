@php
    $teksTentang = trim((string) ($profil->tentang ?? ''));
@endphp

<div style="background:#fff; border-radius:10px; padding:18px 20px; margin-top:8px;
            box-shadow:0 1px 3px rgba(0,0,0,.08);">

    <h3 style="margin:0 0 10px; font-size:15px; color:#1f2328;">🏫 Tentang Sekolah</h3>

    @if($teksTentang !== '')
        <p style="margin:0; font-size:13px; line-height:1.7; color:#3a3f45;">
            {!! nl2br(e($teksTentang)) !!}
        </p>
    @else
        <p style="margin:0; font-size:12px; color:#5b6168;">Belum ada deskripsi.</p>
    @endif
</div>