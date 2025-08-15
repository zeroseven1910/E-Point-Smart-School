<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\ViolationsAndAchievement;
use App\Models\Point;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function guru()
    
    {
        $totalSiswa = Student::count();
        $totalKelas = ClassModel::count();
        $totalPelanggaran = ViolationsAndAchievement::where('type', 'pelanggaran')->count();
        $totalPrestasi = ViolationsAndAchievement::where('type', 'prestasi')->count();

        // Top 5 Pelanggaran Siswa
        $topPelanggaranSiswa = Student::select('students.name', 'classes.name as class_name')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->join('points', 'students.id', '=', 'points.student_id')
            ->join('violations_and_achievements', 'points.violation_id', '=', 'violations_and_achievements.id')
            ->where('violations_and_achievements.type', 'pelanggaran')
            ->groupBy('students.id', 'students.name', 'classes.name')
            ->orderByRaw('SUM(violations_and_achievements.point) DESC')
            ->selectRaw('SUM(violations_and_achievements.point) as total_points')
            ->limit(5)
            ->get();

        // Statistik Pelanggaran Terbanyak
        $pelanggaranTerbanyak = ViolationsAndAchievement::select('description')
            ->join('points', 'violations_and_achievements.id', '=', 'points.violation_id')
            ->where('type', 'pelanggaran')
            ->groupBy('violations_and_achievements.id', 'description')
            ->orderByRaw('COUNT(*) DESC')
            ->selectRaw('COUNT(*) as total')
            ->limit(5)
            ->get();

        return view('dashboard.guru', compact(
            'totalSiswa', 'totalKelas', 'totalPelanggaran', 'totalPrestasi',
            'topPelanggaranSiswa', 'pelanggaranTerbanyak'
        ));
    }

    public function tataTertib()
    {
        $totalSiswa = Student::count();
        $totalPelanggaran = Point::join('violations_and_achievements', 'points.violation_id', '=', 'violations_and_achievements.id')
            ->where('violations_and_achievements.type', 'pelanggaran')
            ->count();
        $totalPrestasi = Point::join('violations_and_achievements', 'points.violation_id', '=', 'violations_and_achievements.id')
            ->where('violations_and_achievements.type', 'prestasi')
            ->count();

        // History Input Pelanggaran Siswa
        $historyPelanggaran = Point::with(['student', 'student.class', 'violation'])
            ->join('violations_and_achievements', 'points.violation_id', '=', 'violations_and_achievements.id')
            ->orderBy('points.date', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.tata-tertib', compact(
            'totalSiswa', 'totalPelanggaran', 'totalPrestasi', 'historyPelanggaran'
        ));
    }
}
