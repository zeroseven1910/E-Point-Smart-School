@extends('layouts.app')

@section('title', 'Edit Kelas')
@section('page-title', 'Edit Kelas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Kelas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('classes.update', $class->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $class->name) }}" required readonly
                               placeholder="Nama kelas akan otomatis terisi">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Nama kelas akan otomatis terisi berdasarkan pilihan tingkat, jurusan, dan nomor kelas
                            </small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tingkat" class="form-label">Tingkat Kelas</label>
                        <select class="form-select @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="10" {{ old('tingkat', substr($class->name, 0, 2)) == '10' ? 'selected' : '' }}>Kelas 10</option>
                            <option value="11" {{ old('tingkat', substr($class->name, 0, 2)) == '11' ? 'selected' : '' }}>Kelas 11</option>
                            <option value="12" {{ old('tingkat', substr($class->name, 0, 2)) == '12' ? 'selected' : '' }}>Kelas 12</option>
                        </select>
                        @error('tingkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                        </select>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nomor_kelas" class="form-label">Nomor Kelas</label>
                        <select class="form-select @error('nomor_kelas') is-invalid @enderror" id="nomor_kelas" name="nomor_kelas" required>
                            <option value="">Pilih Nomor Kelas</option>
                        </select>
                        @error('nomor_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
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

@push('scripts')
<script>
    const jurusanOptions = {
        '10': [
            { value: 'AK', text: 'Akuntansi', max: 4 },
            { value: 'OTKP', text: 'Otomatisasi Tata Kelola Perkantoran', max: 3 },
            { value: 'MP', text: 'Manajemen Perkantoran', max: 3 },
            { value: 'DKV', text: 'Desain Komunikasi Visual', max: 3 },
            { value: 'TJKT', text: 'Teknik Jaringan Komputer dan Telekomunikasi', max: 2 },
            { value: 'PPLG', text: 'Pengembangan Perangkat Lunak dan Gim', max: 1 }
        ],
        '11': [
            { value: 'AK', text: 'Akuntansi', max: 4 },
            { value: 'OTKP', text: 'Otomatisasi Tata Kelola Perkantoran', max: 3 },
            { value: 'BD', text: 'Bisnis Daring', max: 1 },
            { value: 'BR', text: 'Bisnis Ritel', max: 2 },
            { value: 'DKV', text: 'Desain Komunikasi Visual', max: 3 },
            { value: 'TKJ', text: 'Teknik Komputer dan Jaringan', max: 2 },
            { value: 'RPL', text: 'Rekayasa Perangkat Lunak', max: 1 }
        ],
        '12': [
            { value: 'AK', text: 'Akuntansi', max: 4 },
            { value: 'OTKP', text: 'Otomatisasi Tata Kelola Perkantoran', max: 3 },
            { value: 'BD', text: 'Bisnis Daring', max: 1 },
            { value: 'BR', text: 'Bisnis Ritel', max: 2 },
            { value: 'DKV', text: 'Desain Komunikasi Visual', max: 3 },
            { value: 'TKJ', text: 'Teknik Komputer dan Jaringan', max: 2 },
            { value: 'RPL', text: 'Rekayasa Perangkat Lunak', max: 1 }
        ]
    };

    // Parse existing class name to set initial values
    const currentClassName = "{{ $class->name }}";
    const classParts = currentClassName.split(' ');
    let currentTingkat = '', currentJurusan = '', currentNomor = '';
    
    if (classParts.length >= 3) {
        currentTingkat = classParts[0];
        currentJurusan = classParts[1];
        currentNomor = classParts[2];
    }

    document.getElementById('tingkat').addEventListener('change', function() {
        const tingkat = this.value;
        const jurusanSelect = document.getElementById('jurusan');
        const nomorKelasSelect = document.getElementById('nomor_kelas');
        
        jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';
        nomorKelasSelect.innerHTML = '<option value="">Pilih Nomor Kelas</option>';
        
        if (tingkat && jurusanOptions[tingkat]) {
            jurusanOptions[tingkat].forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan.value;
                option.textContent = jurusan.text;
                option.dataset.max = jurusan.max;
                if (jurusan.value === currentJurusan) {
                    option.selected = true;
                }
                jurusanSelect.appendChild(option);
            });
            
            // Trigger change event to populate nomor kelas
            if (currentJurusan) {
                jurusanSelect.dispatchEvent(new Event('change'));
            }
        }
        updateClassName();
    });

    document.getElementById('jurusan').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const maxKelas = selectedOption.dataset.max;
        const nomorKelasSelect = document.getElementById('nomor_kelas');
        
        nomorKelasSelect.innerHTML = '<option value="">Pilih Nomor Kelas</option>';
        
        if (maxKelas) {
            for (let i = 1; i <= parseInt(maxKelas); i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (i.toString() === currentNomor) {
                    option.selected = true;
                }
                nomorKelasSelect.appendChild(option);
            }
        }
        updateClassName();
    });

    document.getElementById('nomor_kelas').addEventListener('change', updateClassName);

    function updateClassName() {
        const tingkat = document.getElementById('tingkat').value;
        const jurusan = document.getElementById('jurusan').value;
        const nomorKelas = document.getElementById('nomor_kelas').value;
        const nameField = document.getElementById('name');
        
        if (tingkat && jurusan && nomorKelas) {
            nameField.value = `${tingkat} ${jurusan} ${nomorKelas}`;
        }
    }

    // Initialize on page load
    if (currentTingkat) {
        document.getElementById('tingkat').value = currentTingkat;
        document.getElementById('tingkat').dispatchEvent(new Event('change'));
    }
</script>
@endpush
@endsection