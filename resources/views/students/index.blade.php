@extends('layouts.app')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Siswa</h5>
        <div>
            <input type="text" class="form-control d-inline-block me-2" style="width: 250px;" placeholder="Cari siswa..." id="searchInput">
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Tambah Siswa
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Total Poin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    @forelse($students as $index => $student)
                    <tr>
                        <td>{{ $students->firstItem() + $index }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->class->name }}</td>
                        <td>
                            <span class="badge bg-{{ $student->total_points > 0 ? 'danger' : 'success' }}">
                                {{ $student->total_points }} Poin
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('points.history', $student->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-history"></i> History
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const query = this.value;
        
        if (query.length > 2) {
            fetch(`{{ route('students.search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('studentTableBody');
                    tbody.innerHTML = '';
                    
                    if (data.length > 0) {
                        data.forEach((student, index) => {
                            tbody.innerHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${student.nis}</td>
                                    <td>${student.name}</td>
                                    <td>${student.class.name}</td>
                                    <td><span class="badge bg-success">0 Poin</span></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/points/history/${student.id}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-history"></i> History
                                            </a>
                                            <a href="/students/${student.id}/edit" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center">Tidak ada siswa ditemukan</td></tr>';
                    }
                });
        }
    });
</script>
@endpush
