@csrf

<div class="form-group">
    <label for="nama">Nama Ekstrakurikuler</label>
    <input type="text" name="nama" id="nama"
           value="{{ old('nama', $ekstrakurikuler->nama ?? '') }}"
           class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" required>
    @error('nama') <div class="error-text">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="jadwal">Jadwal</label>
    <input type="text" name="jadwal" id="jadwal"
           value="{{ old('jadwal', $ekstrakurikuler->jadwal ?? '') }}"
           class="form-control" placeholder="Contoh: Senin dan Jumat, 14.00-16.00">
    @error('jadwal') <div class="error-text">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control">{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="error-text">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="gambar">Gambar</label>

    @if (!empty($ekstrakurikuler) && $ekstrakurikuler->gambar_url)
        <img src="{{ $ekstrakurikuler->gambar_url }}" alt="Gambar saat ini"
             style="display:block; max-width:220px; border-radius:8px; margin-bottom:8px;">
        <div class="muted">Kosongkan jika tidak ingin mengganti gambar.</div>
    @endif

    <input type="file" name="gambar" id="gambar" accept="image/*" class="form-control">
    @error('gambar') <div class="error-text">{{ $message }}</div> @enderror
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-outline">Batal</a>
</div>