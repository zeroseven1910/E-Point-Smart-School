@extends('layouts.app')

@section('title', 'Bentuk Pelanggaran')
@section('page-title', 'Bentuk Pelanggaran')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Bentuk Pelanggaran & Prestasi</h5>
        <a href="{{ route('violations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Pelanggaran
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Bentuk Pelanggaran</th>
                        <th>Bobot</th>
                        <th>Ops</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($violations as $index => $violation)
                    <tr>
                        <td>{{ $violations->firstItem() + $index }}</td>
                        <td>
                            <span class="badge bg-{{ $violation->type === 'pelanggaran' ? 'danger' : 'success' }}">
                                {{ ucfirst($violation->type) }}
                            </span>
                        </td>
                        <td>{{ $violation->description }}</td>
                        <td>
                            <span class="badge bg-{{ $violation->type === 'pelanggaran' ? 'danger' : 'success' }}">
                                {{ $violation->point }} Poin
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('violations.edit', $violation->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('violations.destroy', $violation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
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
        
        <div class="d-flex justify-content-center">
            {{ $violations->links() }}
        </div>
    </div>
</div>
@endsection