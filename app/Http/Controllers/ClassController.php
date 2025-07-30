<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::withCount('students')->paginate(10);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classes',
        ]);

        ClassModel::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(ClassModel $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classes,name,' . $class->id,
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus');
    }
}
