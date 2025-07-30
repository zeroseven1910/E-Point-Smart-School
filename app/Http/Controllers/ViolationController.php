<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViolationAndAchievement;

class ViolationController extends Controller
{
    public function index()
    {
        $violations = ViolationAndAchievement::paginate(15);
        return view('violations.index', compact('violations'));
    }

    public function create()
    {
        return view('violations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pelanggaran,prestasi',
            'description' => 'required|string',
            'point' => 'required|integer',
        ]);

        ViolationAndAchievement::create($request->all());

        return redirect()->route('violations.index')->with('success', 'Pelanggaran/Prestasi berhasil ditambahkan');
    }

    public function edit(ViolationAndAchievement $violation)
    {
        return view('violations.edit', compact('violation'));
    }

    public function update(Request $request, ViolationAndAchievement $violation)
    {
        $request->validate([
            'type' => 'required|in:pelanggaran,prestasi',
            'description' => 'required|string',
            'point' => 'required|integer',
        ]);

        $violation->update($request->all());

        return redirect()->route('violations.index')->with('success', 'Pelanggaran/Prestasi berhasil diperbarui');
    }

    public function destroy(ViolationAndAchievement $violation)
    {
        $violation->delete();
        return redirect()->route('violations.index')->with('success', 'Pelanggaran/Prestasi berhasil dihapus');
    }
}

