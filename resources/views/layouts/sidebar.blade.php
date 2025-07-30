<div class="sidebar">
    <div class="text-center py-4">
        <h4 class="text-white">E-Point</h4>
        <p class="text-white-50">Smart School</p>
    </div>
    
    <nav class="nav flex-column">
        @if(Auth::user()->role === 'guru')
            <a class="nav-link {{ request()->routeIs('dashboard.guru') ? 'active' : '' }}" href="{{ route('dashboard.guru') }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <i class="fas fa-users me-2"></i> Data Siswa
            </a>
            <a class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}" href="{{ route('classes.index') }}">
                <i class="fas fa-school me-2"></i> Kelas
            </a>
            <a class="nav-link {{ request()->routeIs('violations.*') ? 'active' : '' }}" href="{{ route('violations.index') }}">
                <i class="fas fa-exclamation-triangle me-2"></i> Pelanggaran
            </a>
        @else
            <a class="nav-link {{ request()->routeIs('dashboard.tata-tertib') ? 'active' : '' }}" href="{{ route('dashboard.tata-tertib') }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('points.*') ? 'active' : '' }}" href="{{ route('points.index') }}">
                <i class="fas fa-star me-2"></i> Input Point
            </a>
            <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <i class="fas fa-users me-2"></i> Cari Siswa
            </a>
        @endif
        
        <a class="nav-link" href="{{ route('violations.index') }}">
            <i class="fas fa-list me-2"></i> Bentuk Pelanggaran
        </a>
    </nav>
</div>