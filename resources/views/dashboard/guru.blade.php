@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('page-title', 'Dashboard Guru')

@section('content')

<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
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
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $totalKelas }}</h3>
                    <p class="mb-0">Total Kelas</p>
                </div>
                <i class="fas fa-school fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $totalPelanggaran }}</h3>
                    <p class="mb-0">Jenis Pelanggaran</p>
                </div>
                <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $totalPrestasi }}</h3>
                    <p class="mb-0">Jenis Prestasi</p>
                </div>
                <i class="fas fa-trophy fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Top 5 Pelanggaran Siswa</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Total Poin Pelanggaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topPelanggaranSiswa as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->name }}</td>
                                <td>{{ $siswa->class_name }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $siswa->total_points }} Poin</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data pelanggaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Pelanggaran Terbanyak</h5>
            </div>
            <div class="card-body">
                <canvas id="pelanggaranChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Chart for Pelanggaran Terbanyak
    const ctx = document.getElementById('pelanggaranChart').getContext('2d');
    const pelanggaranData = @json($pelanggaranTerbanyak);
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: pelanggaranData.map(item => item.description.substring(0, 20) + '...'),
            datasets: [{
                data: pelanggaranData.map(item => item.total),
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB', 
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush