<?php
namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jurusan::query();
        if ($request->search) {
            $query->where('nama_jurusan', 'like', '%'.$request->search.'%');
        }
        $jurusans = $query->paginate(10);
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'akreditasi'   => 'required|string|max:5',
        ]);
        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'akreditasi'   => 'required|string|max:5',
        ]);
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diupdate!');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
    
    // PRINT CSV
    public function exportCsv()
    {
        $fileName = 'data_jurusan.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter UTF-8 terbaca dengan rapi di Excel tanpa berantakan
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header kolom CSV
            fputcsv($file, [
                'ID JURUSAN',
                'NAMA PROGRAM STUDI / JURUSAN',
                'AKREDITASI',
                'TOTAL MAHASISWA',
                'TOTAL MATAKULIAH'
            ], ';'); // Menggunakan delimiter titik koma

            // Mengambil data jurusan beserta relasi untuk menghitung jumlahnya
            $jurusans = Jurusan::with(['mahasiswas', 'matakuliahs'])->get();

            foreach ($jurusans as $j) {
                fputcsv($file, [
                    $j->id_jurusan,
                    $j->nama_jurusan,
                    $j->akreditasi,
                    $j->mahasiswas->count() . ' Orang',
                    $j->matakuliahs->count() . ' MK',
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    // PRINT PDF
    public function print()
    {
        // Mengambil semua data jurusan beserta relasi mahasiswa dan matakuliahnya
        $jurusans = Jurusan::with(['mahasiswas', 'matakuliahs'])->get();

        return view('jurusan.print', compact('jurusans'));
    }
    
    // PRINT EXCEL
    public function exportExcel()
    {
        $jurusans = Jurusan::with(['mahasiswas', 'matakuliahs'])->get();

        return response()
            ->view('jurusan.excel', compact('jurusans'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=data_jurusan.xls');
    }    
}