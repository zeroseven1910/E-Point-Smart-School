@extends('layouts.app')

@section('title', 'Data Poin Siswa')
@section('page-title', 'Data Poin Siswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Seluruh Pelanggaran Siswa (Belum Lanjut)</h5>
        <a href="{{ route('points.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Input Pelanggaran
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
                        <th>Bobot</th>
                        <th>Pada</th>
                        <th>Ops</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($points as $index => $point)
                    <tr>
                        <td>{{ $points->firstItem() + $index }}</td>
                        <td>{{ $point->student->name }}</td>
                        <td>{{ $point->student->class->name }}</td>
                        <td>{{ $point->violation->description }}</td>
                        <td>
                            <span class="badge bg-{{ $point->violation->type === 'pelanggaran' ? 'danger' : 'success' }}">
                                {{ $point->violation->point }}
                            </span>
                        </td>
                        <td>{{ $point->date->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('points.destroy', $point->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
        
        <div class="d-flex justify-content-center">
            {{ $points->links() }}
        </div>
    </div>
</div>
@endsection