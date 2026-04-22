<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('jurusan');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                ->orWhere('nim',  'like', '%'.$request->search.'%');
            });
        }

        if ($request->jurusan) {
            $query->where('id_jurusan', $request->jurusan);
        }

        $query->orderBy('nim');

        $mahasiswas = $query->paginate(10);
        $jurusans   = \App\Models\Jurusan::all();

        return view('mahasiswa.index', compact('mahasiswas', 'jurusans'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'        => 'required|unique:mahasiswas,nim',
            'nama'       => 'required|string|max:100',
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
        ]);
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim'        => 'required|unique:mahasiswas,nim,'.$mahasiswa->id_mahasiswa.',id_mahasiswa',
            'nama'       => 'required|string|max:100',
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
        ]);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
    
}