<!-- resources/views/classes/index.blade.php -->
@extends('layouts.app')

@section('title', 'Data Kelas')
@section('page-title', 'Data Kelas')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kelas</h5>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Kelas
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Siswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $index => $class)
                    <tr>
                        <td>{{ $classes->firstItem() + $index }}</td>
                        <td>{{ $class->name }}</td>
                        <td>
                            <span class="badge bg-info">{{ $class->students_count }} Siswa</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini? Siswa dalam kelas ini juga akan terhapus.')">
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
                        <td colspan="4" class="text-center">Belum ada data kelas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $classes->links() }}
        </div>
    </div>
</div>
@endsection