@extends('layouts.app')

@section('title', 'Input Pelanggaran')
@section('page-title', 'Input Pelanggaran Siswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Input Pelanggaran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('points.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Pilih Siswa</label>
                                <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                    <option value="">Pilih Siswa</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }} - {{ $student->class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                       id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="violation_id" class="form-label">Bentuk Pelanggaran</label>
                        <select class="form-select @error('violation_id') is-invalid @enderror" id="violation_id" name="violation_id" required>
                            <option value="">Pilih Pelanggaran</option>
                            @foreach($violations as $violation)
                                <option value="{{ $violation->id }}" data-point="{{ $violation->point }}" data-type="{{ $violation->type }}" {{ old('violation_id') == $violation->id ? 'selected' : '' }}>
                                    {{ $violation->description }} ({{ $violation->point }} poin)
                                </option>
                            @endforeach
                        </select>
                        @error('violation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="3" placeholder="Tambahkan catatan jika diperlukan">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div id="pointPreview" class="alert alert-info d-none">
                        <strong>Preview:</strong> <span id="pointText"></span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('points.index') }}" class="btn btn-secondary">
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

@push('scripts')
<script>
    document.getElementById('violation_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const point = selectedOption.getAttribute('data-point');
        const type = selectedOption.getAttribute('data-type');
        const preview = document.getElementById('pointPreview');
        const pointText = document.getElementById('pointText');
        
        if (point && type) {
            const typeText = type === 'pelanggaran' ? 'dikurangi' : 'ditambah';
            const color = type === 'pelanggaran' ? 'danger' : 'success';
            
            pointText.innerHTML = `Poin siswa akan ${typeText} sebesar <span class="badge bg-${color}">${point} poin</span>`;
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush

