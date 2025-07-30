@extends('layouts.app')

@section('title', 'History Poin Siswa')
@section('page-title', 'History Poin Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-1">{{ $student->name }}</h4>
                        <p class="text-muted mb-0">NIS: {{ $student->nis }} | Kelas: {{ $student->class->name }}</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <h2 class="mb-0">
                            <span class="badge bg-{{ $totalPoints > 0 ? 'danger' : 'success' }} fs-4">
                                {{ $totalPoints }} Poin
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Pelanggaran & Prestasi</h5>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Poin</th>
                        <th>Petugas</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($points as $index => $point)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $point->date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $point->violation->type === 'pelanggaran' ? 'danger' : 'success' }}">
                                {{ ucfirst($point->violation->type) }}
                            </span>
                        </td>
                        <td>{{ $point->violation->description }}</td>
                        <td>
                            <span class="badge bg-{{ $point->violation->type === 'pelanggaran' ? 'danger' : 'success' }}">
                                {{ $point->violation->type === 'pelanggaran' ? '+' : '-' }}{{ $point->violation->point }}
                            </span>
                        </td>
                        <td>{{ $point->user->name }}</td>
                        <td>{{ $point->notes ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada riwayat pelanggaran atau prestasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
