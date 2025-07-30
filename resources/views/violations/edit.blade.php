@extends('layouts.app')

@section('title', 'Edit Pelanggaran')
@section('page-title', 'Edit Pelanggaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Pelanggaran/Prestasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('violations.update', $violation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="type" class="form-label">Kategori</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Pilih Kategori</option>
                            <option value="pelanggaran" {{ old('type', $violation->type) == 'pelanggaran' ? 'selected' : '' }}>Pelanggaran</option>
                            <option value="prestasi" {{ old('type', $violation->type) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Bentuk Pelanggaran/Prestasi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required 
                                  placeholder="Deskripsikan bentuk pelanggaran atau prestasi">{{ old('description', $violation->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="point" class="form-label">Bobot Poin</label>
                        <input type="number" class="form-control @error('point') is-invalid @enderror" 
                               id="point" name="point" value="{{ old('point', $violation->point) }}" required 
                               placeholder="Masukkan bobot poin (angka positif)">
                        @error('point')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('violations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
