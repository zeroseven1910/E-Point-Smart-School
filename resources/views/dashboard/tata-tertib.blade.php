@extends('layouts.app')

@section('title', 'Dashboard Tata Tertib')
@section('page-title', 'Dashboard Tata Tertib')

@section('content')
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $totalSiswa }}</h3>
                    <p class="mb-0">Total Siswa</p>
                </div>
                <i class="fas fa-users fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $totalPelanggaran }}</h3>
                    <p class="mb-0">Total Pelanggaran</p>
                </div>
                <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $totalPrestasi }}</h3>
                    <p class="mb-0">Total Prestasi</p>
                </div>
                <i class="fas fa-trophy fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">History Input Pelanggaran Siswa</h5>
                <a href="{{ route('points.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Input Pelanggaran Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bentuk Pelanggaran</th>
                                <th>Poin</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($historyPelanggaran as $index => $point)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $point->student->name }}</td>
                                <td>{{ $point->student->class->name }}</td>
                                <td>{{ $point->violation->description }}</td>
                                <td>
                                    <span class="badge bg-{{ $point->violation->type === 'pelanggaran' ? 'danger' : 'success' }}">
                                        {{ $point->violation->point }} Poin
                                    </span>
                                </td>
                                <td>{{ $point->date->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('points.history', $point->student_id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data pelanggaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection