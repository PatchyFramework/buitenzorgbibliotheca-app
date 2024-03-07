<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\KategoriBukuRelasi;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        $kategori = KategoriBuku::all();
        $kategorirelasi = KategoriBukuRelasi::with(['kategoriBuku', 'buku'])->get();
        // dd($buku);


        return view('dashboard.buku', compact(['buku', 'kategori', 'kategorirelasi']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $path = null;

        if ($request->hasFile('ImgBuku')) {

            // Ambil ekstensi file yang diunggah
            $extension = $request->file('ImgBuku')->extension();

            // Buat nama file baru dengan format yang Anda inginkan
            $fileName = time() . 'buku' . '_' . $request->Barcode . '.' . $extension;

            // Simpan gambar dengan nama file kustom
            $path = $request->file('ImgBuku')->storeAs('buku/photos', $fileName, 'public');
        }

        // Buat entitas Buku dengan menggunakan path gambar yang telah disimpan
        $buku = Buku::create([
            'Barcode' => $request->Barcode,
            'Judul' => $request->Judul,
            'Penulis' => $request->Penulis,
            'Penerbit' => $request->Penerbit,
            'KategoriID' => $request->KategoriID,
            'TahunTerbit' => $request->TahunTerbit,
            'Synopsis' => $request->Synopsis,
            'Stock' => $request->Stock,
            'StatusKetersediaan' => 'Tersedia',
            'ImgBuku' => $path ? 'storage/' . $path : null,
        ]);

        // Ambil BukuID yang baru saja dibuat
        $bukuID = $buku->BukuID;

        // Simpan KategoriBukuRelasi menggunakan BukuID yang baru saja dibuat
        KategoriBukuRelasi::create([
            'BukuID' => $bukuID,
            'KategoriID' => $request->KategoriID,
        ]);

        // Redirect ke halaman indeks buku
        return redirect()->route('buku.index');


        // $requestData = $request->all();
        // $fileName = $request->file('ImgBuku')->getClientOriginalName();
        // $path = $request->file('ImgBuku')->storeAs('buku/photos', $fileName, 'public');
        // $requestData["ImgBuku"] = 'storage/'. $path;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $monthNow = Carbon::now()->month;
        $yearNow = Carbon::now()->year;

        $buku = Buku::all();
        $kategori = KategoriBuku::all();
        $kategorirelasi = KategoriBukuRelasi::with(['kategoriBuku', 'buku'])
        ->whereYear('created_at', $yearNow)
        ->whereMonth('created_at', $monthNow)
        ->get();

        $peminjaman = Peminjaman::select('BukuID', DB::raw('count(*) as total_peminjaman'))
        ->whereMonth('created_at', $monthNow)
        ->groupBy('BukuID')
        ->get();

        $pdf = PDF::loadView('pdfs.laporanbooks', compact('buku', 'kategori', 'kategorirelasi', 'peminjaman'));

        // Stream untuk menampilkan tampilan PDF pada browser
        return $pdf->stream('table.pdf');
    }

    public function exportexcel() {
        return Excel::download(new BukuExport, 'buku.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('dashboard/detailbuku', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        // Temukan data buku berdasarkan ID
        $buku = Buku::find($id);

        $stock = $request->Stock;

        // Temukan entri kategoribuku_relasi yang sesuai dengan buku yang diubah
        $kategorirelasi = KategoriBukuRelasi::where('BukuID', $id)->first();

        if ($request->has('Stock')) {
            if ($request->Stock > 0) {
                $buku->Stock += $stock;
                $buku->save();
            }
        }

        // Cek apakah ada file baru diunggah
        if ($request->hasFile('ImgBuku')) {
            // Ambil ekstensi file yang diunggah
            $extension = $request->file('ImgBuku')->extension();

            // Buat nama file baru dengan format yang Anda inginkan
            $fileName = time() . 'buku' . '_' . $request->Barcode . '.' . $extension;

            // Proses file gambar baru dengan nama file kustom
            $path = $request->file('ImgBuku')->storeAs('buku/photos', $fileName, 'public');
            $buku->ImgBuku = 'storage/' . $path;
        }

        // Update data buku tanpa mengubah gambar
        $buku->update($request->except(['ImgBuku', 'Stock']));

        // Update kategoribuku_relasi jika entri ditemukan
        if ($kategorirelasi) {
            $kategorirelasi->update(['KategoriID' => $request->input('KategoriID')]);
        }

        // Redirect ke halaman buku setelah update
        return redirect()->route('buku.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $buku = Buku::find($id);
        $kategorirelasi = KategoriBukuRelasi::where('BukuID', $id)->first();
        $kategorirelasi->delete();
        $buku->delete();


        // Redirect ke halaman buku setelah update
        return redirect()->route('buku.index');
    }
}

