@csrf
@isset($galeri) @method('PUT') @endisset

<div class="form-group">
    <label for="judul">Judul <span style="color:red;">*</span></label>
    <input type="text" id="judul" name="judul" required maxlength="255"
           class="form-control @error('judul') is-invalid @enderror"
           value="{{ old('judul', $galeri->judul ?? '') }}">
    @error('judul') <div class="error-text">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="4"
              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="error-text">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="foto">
        Foto
        @isset($galeri)
            <span class="muted">(kosongkan jika tidak diganti, maks. 2 MB)</span>
        @else
            <span style="color:red;">*</span> <span class="muted">(maks. 2 MB)</span>
        @endisset
    </label>
    <input type="file" id="foto" name="foto" accept="image/*"
           class="form-control @error('foto') is-invalid @enderror"
           @empty($galeri) required @endempty>
    @error('foto') <div class="error-text">{{ $message }}</div> @enderror

    <img id="preview" class="preview" alt="Preview"
         @isset($galeri) src="{{ $galeri->foto_url }}" style="display:block;" @endisset>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-gold">Simpan</button>
    <a href="{{ route('galeri.index') }}" class="btn btn-outline">Batal</a>
</div>

@push('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function (e) {
        const img = document.getElementById('preview');
        const file = e.target.files[0];
        if (file) {
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
        }
    });
</script>
@endpush