<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $tamu->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Telepon</label>
    <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $tamu->telepon ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $tamu->alamat ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Keperluan</label>
    <input type="text" name="keperluan" class="form-control" value="{{ old('keperluan', $tamu->keperluan ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="kategori" class="form-label fw-semibold">Kategori</label>
    <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
        <option value="" disabled {{ old('kategori', $tamu->kategori ?? '') == '' ? 'selected' : '' }}>-- Pilih Kategori --</option>
        <option value="Wali Santri" {{ old('kategori', $tamu->kategori ?? '') == 'Wali Santri' ? 'selected' : '' }}>Wali Santri</option>
        <option value="Tamu Hotel" {{ old('kategori', $tamu->kategori ?? '') == 'Tamu Hotel' ? 'selected' : '' }}>Tamu Hotel</option>
        <option value="Orangtua Siswa" {{ old('kategori', $tamu->kategori ?? '') == 'Orangtua Siswa' ? 'selected' : '' }}>Orangtua Siswa</option>
        <option value="Kunjungan Dinas" {{ old('kategori', $tamu->kategori ?? '') == 'Kunjungan Dinas' ? 'selected' : '' }}>Kunjungan Dinas</option>
        <option value="Calon Siswa" {{ old('kategori', $tamu->kategori ?? '') == 'Calon Siswa' ? 'selected' : '' }}>Calon Siswa</option>
        <option value="Tokoh Masyarakat" {{ old('kategori', $tamu->kategori ?? '') == 'Tokoh Masyarakat' ? 'selected' : '' }}>Tokoh Masyarakat</option>
        <option value="Kunjungan Sekolah" {{ old('kategori', $tamu->kategori ?? '') == 'Kunjungan Sekolah' ? 'selected' : '' }}>Kunjungan Sekolah</option>
    </select>
    @error('kategori')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Tanggal Datang</label>
    <input type="datetime-local" name="tanggal_datang" class="form-control"
        value="{{ old('tanggal_datang', isset($tamu) ? \Carbon\Carbon::parse($tamu->tanggal_datang)->format('Y-m-d\TH:i') : '') }}" required>
</div>
