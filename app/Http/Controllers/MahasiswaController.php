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
    // PRINT CSV
    public function exportCsv()
    {
        $fileName = 'mahasiswa.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () {

            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter UTF-8 terbaca baik di Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header kolom
            fputcsv($file, [
                'ID',
                'NIM',
                'Nama',
                'Jurusan'
            ], ';');

            $mahasiswa = Mahasiswa::with('jurusan')->get();

            foreach ($mahasiswa as $item) {

                fputcsv($file, [
                    $item->id_mahasiswa,
                    $item->nim,
                    $item->nama,
                    $item->jurusan->nama_jurusan ?? '-',
                ], ';'); // delimiter titik koma
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // PRINT PDF
    public function print()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        return view('mahasiswa.print', compact('mahasiswa'));
    }

    // PRINT EXCEL
    public function exportExcel()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        return response()
            ->view('mahasiswa.excel', compact('mahasiswa'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=mahasiswa.xls');
    }
    
}