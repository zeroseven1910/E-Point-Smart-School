@extends('layouts.app')

@section('title', 'Tambah Pelanggaran')
@section('page-title', 'Tambah Pelanggaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Pelanggaran/Prestasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('violations.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Kategori</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Pilih Kategori</option>
                            <option value="pelanggaran" {{ old('type') == 'pelanggaran' ? 'selected' : '' }}>Pelanggaran</option>
                            <option value="prestasi" {{ old('type') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Bentuk Pelanggaran/Prestasi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required 
                                  placeholder="Deskripsikan bentuk pelanggaran atau prestasi">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="point" class="form-label">Bobot Poin</label>
                        <input type="number" class="form-control @error('point') is-invalid @enderror" 
                               id="point" name="point" value="{{ old('point') }}" required 
                               placeholder="Masukkan bobot poin (angka positif)">
                        @error('point')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Untuk pelanggaran: poin akan menambah total poin siswa (semakin tinggi semakin buruk)<br>
                                Untuk prestasi: poin akan mengurangi total poin siswa (reward)
                            </small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('violations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

