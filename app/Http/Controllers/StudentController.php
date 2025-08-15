<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar siswa
     */
    public function index()
    {
        $students = Student::with('class')->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Form tambah siswa
     */
    public function create()
    {
        $classes = ClassModel::all();
        return view('students.create', compact('classes'));
    }

    /**
     * Simpan siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'nis'       => 'required|string|max:50|unique:students,nis',
            'class_id'  => 'required|exists:classes,id',
        ]);

        Student::create([
            'name'      => $request->name,
            'nis'       => $request->nis,
            'class_id'  => $request->class_id,
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail siswa
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Form edit siswa
     */
    public function edit(Student $student)
    {
        $classes = ClassModel::all();
        return view('students.edit', compact('student', 'classes'));
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'nis'       => 'required|string|max:50|unique:students,nis,' . $student->id,
            'class_id'  => 'required|exists:classes,id',
        ]);

        $student->update([
            'name'      => $request->name,
            'nis'       => $request->nis,
            'class_id'  => $request->class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Hapus siswa
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }

    /**
     * Cari siswa (Ajax)
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        $students = Student::with('class')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('nis', 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get();

        return response()->json($students);
    }
}
