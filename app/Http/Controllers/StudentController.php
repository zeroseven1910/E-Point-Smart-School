<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students',
            'class_id' => 'required|exists:classes,id',
        ]);

        Student::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'class_id' => $request->class_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $classes = ClassModel::all();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'class_id' => 'required|exists:classes,id',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $students = Student::with('class')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('nis', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($students);
    }
}