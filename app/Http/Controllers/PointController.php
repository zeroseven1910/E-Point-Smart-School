<?php
// app/Http/Controllers/PointController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Student;
use App\Models\ViolationAndAchievement;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::with(['student', 'student.class', 'violation', 'user'])
            ->orderBy('date', 'desc')
            ->paginate(15);
        
        return view('points.index', compact('points'));
    }

    public function create()
    {
        $students = Student::with('class')->get();
        $violations = ViolationAndAchievement::all();
        return view('points.create', compact('students', 'violations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'violation_id' => 'required|exists:violations_and_achievements,id',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Point::create([
            'student_id' => $request->student_id,
            'violation_id' => $request->violation_id,
            'user_id' => Auth::id(),
            'date' => $request->date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('points.index')->with('success', 'Point berhasil ditambahkan');
    }

    public function history($studentId)
    {
        $student = Student::with('class')->findOrFail($studentId);
        $points = Point::with(['violation', 'user'])
            ->where('student_id', $studentId)
            ->orderBy('date', 'desc')
            ->get();

        $totalPoints = $points->sum(function($point) {
            return $point->violation->point;
        });

        return view('points.history', compact('student', 'points', 'totalPoints'));
    }

    public function destroy(Point $point)
    {
        $point->delete();
        return redirect()->route('points.index')->with('success', 'Point berhasil dihapus');
    }
}