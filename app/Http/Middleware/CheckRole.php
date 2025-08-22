<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Jika tidak ada role yang diberikan, lanjutkan
        if (empty($roles)) {
            return $next($request);
        }

        // Normalisasi role user dan role yang diperbolehkan (biar tidak case-sensitive)
        $userRole = strtolower($user->role ?? '');
        $allowedRoles = array_map('strtolower', $roles);

        // Debug (sementara, hapus kalau sudah jelas)
        // dd([
        //     'userRole' => $userRole,
        //     'rolesDiperlukan' => $allowedRoles,
        // ]);

        // Cek apakah user memiliki salah satu role yang diizinkan
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // Jika tidak memiliki akses → redirect ke halaman khusus unauthorized
        return redirect('/unauthorized')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
