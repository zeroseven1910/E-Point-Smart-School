<?php
// app/Http/Controllers/ClassController.php (Updated)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::withCount('students')
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '10%' THEN 1
                    WHEN name LIKE '11%' THEN 2
                    WHEN name LIKE '12%' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('name')
            ->paginate(15);
            
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'jurusan' => 'required|string',
            'nomor_kelas' => 'required|integer|min:1',
        ]);

        $className = $request->tingkat . ' ' . $request->jurusan . ' ' . $request->nomor_kelas;

        // Check if class already exists
        if (ClassModel::where('name', $className)->exists()) {
            return back()->withErrors(['name' => 'Kelas ' . $className . ' sudah ada.'])->withInput();
        }

        ClassModel::create([
            'name' => $className,
        ]);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(ClassModel $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'jurusan' => 'required|string',
            'nomor_kelas' => 'required|integer|min:1',
        ]);

        $className = $request->tingkat . ' ' . $request->jurusan . ' ' . $request->nomor_kelas;

        // Check if class already exists (except current class)
        if (ClassModel::where('name', $className)->where('id', '!=', $class->id)->exists()) {
            return back()->withErrors(['name' => 'Kelas ' . $className . ' sudah ada.'])->withInput();
        }

        $class->update([
            'name' => $className,
        ]);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(ClassModel $class)
    {
        if ($class->students()->count() > 0) {
            return redirect()->route('classes.index')->with('error', 'Tidak dapat menghapus kelas yang masih memiliki siswa');
        }

        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus');
    }

    public function getJurusanByTingkat(Request $request)
    {
        $tingkat = $request->tingkat;
        
        $jurusanOptions = [
            '10' => [
                ['value' => 'AK', 'text' => 'Akuntansi', 'max' => 4],
                ['value' => 'OTKP', 'text' => 'Otomatisasi Tata Kelola Perkantoran', 'max' => 3],
                ['value' => 'MP', 'text' => 'Manajemen Perkantoran', 'max' => 3],
                ['value' => 'DKV', 'text' => 'Desain Komunikasi Visual', 'max' => 3],
                ['value' => 'TJKT', 'text' => 'Teknik Jaringan Komputer dan Telekomunikasi', 'max' => 2],
                ['value' => 'PPLG', 'text' => 'Pengembangan Perangkat Lunak dan Gim', 'max' => 1]
            ],
            '11' => [
                ['value' => 'AK', 'text' => 'Akuntansi', 'max' => 4],
                ['value' => 'OTKP', 'text' => 'Otomatisasi Tata Kelola Perkantoran', 'max' => 3],
                ['value' => 'BD', 'text' => 'Bisnis Daring', 'max' => 1],
                ['value' => 'BR', 'text' => 'Bisnis Ritel', 'max' => 2],
                ['value' => 'DKV', 'text' => 'Desain Komunikasi Visual', 'max' => 3],
                ['value' => 'TKJ', 'text' => 'Teknik Komputer dan Jaringan', 'max' => 2],
                ['value' => 'RPL', 'text' => 'Rekayasa Perangkat Lunak', 'max' => 1]
            ],
            '12' => [
                ['value' => 'AK', 'text' => 'Akuntansi', 'max' => 4],
                ['value' => 'OTKP', 'text' => 'Otomatisasi Tata Kelola Perkantoran', 'max' => 3],
                ['value' => 'BD', 'text' => 'Bisnis Daring', 'max' => 1],
                ['value' => 'BR', 'text' => 'Bisnis Ritel', 'max' => 2],
                ['value' => 'DKV', 'text' => 'Desain Komunikasi Visual', 'max' => 3],
                ['value' => 'TKJ', 'text' => 'Teknik Komputer dan Jaringan', 'max' => 2],
                ['value' => 'RPL', 'text' => 'Rekayasa Perangkat Lunak', 'max' => 1]
            ]
        ];

        return response()->json($jurusanOptions[$tingkat] ?? []);
    }
}