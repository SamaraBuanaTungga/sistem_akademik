<?php
namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::with('jurusan');

        if ($request->search) {
            $query->where('nama_matakuliah', 'like', '%'.$request->search.'%');
        }

        if ($request->jurusan) {
            $query->where('id_jurusan', $request->jurusan);
        }
        

        $matakuliahs = $query->paginate(10);
        $jurusans    = \App\Models\Jurusan::all();

        return view('matakuliah.index', compact('matakuliahs', 'jurusans'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('matakuliah.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:100',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusans,id_jurusan',
        ]);
        Matakuliah::create($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan!');
    }

    public function edit(Matakuliah $matakuliah)
    {
        $jurusans = Jurusan::all();
        return view('matakuliah.edit', compact('matakuliah', 'jurusans'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:100',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusans,id_jurusan',
        ]);
        $matakuliah->update($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diupdate!');
    }
    
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus!');
    }
    
    // EXPORT CSV
    public function exportCsv()
    {
        $fileName = 'data_matakuliah.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter UTF-8 terbaca rapi langsung di Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header kolom CSV
            fputcsv($file, [
                'ID MATAKULIAH',
                'NAMA MATAKULIAH',
                'SKS',
                'JURUSAN / PROGRAM STUDI'
            ], ';');

            $matakuliah = Matakuliah::with('jurusan')->get();

            foreach ($matakuliah as $item) {
                fputcsv($file, [
                    $item->id_matakuliah,
                    $item->nama_matakuliah,
                    $item->sks,
                    $item->jurusan->nama_jurusan ?? '-',
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // PRINT PDF
    public function print()
    {
        $matakuliah = Matakuliah::with('jurusan')->get();
        return view('matakuliah.print', compact('matakuliah'));
    }

    // EXPORT EXCEL 
    public function exportExcel()
    {
        $matakuliah = Matakuliah::with('jurusan')->get();

        return response()
            ->view('matakuliah.excel', compact('matakuliah'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=data_matakuliah.xls');
    }

}