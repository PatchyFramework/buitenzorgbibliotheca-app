<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBukuRelasi;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $koleksipribadi = KoleksiPribadi::with('user', 'buku')
            ->where('userid', Auth::id())
            ->get();
        $kategoribuku = KategoriBukuRelasi::all();
            
            // Mengambil semua BukuID dari koleksi pribadi
        $bukuIDs = $koleksipribadi->pluck('KoleksiID')->toArray();
        
        // Memeriksa apakah BukuID dari koleksi pribadi ada dalam tabel KoleksiPribadi
        // $isKoleksi = KoleksiPribadi::where('userid', Auth::id())
        // ->whereIn('BukuID', $bukuIDs)
        // ->exists();
        
        $isKoleksi = KoleksiPribadi::with('buku')->where('userid', Auth::id())
        ->whereIn('KoleksiID', $bukuIDs)->get();
        // dd($isKoleksi);
        
        // $koleksi = KoleksiPribadi::where('userid', Auth::id())
        // ->where('BukuID', $bukuIDs)
        // ->first();

    
        return view('koleksi.koleksi', compact('pinjamcount', 'koleksicount', 'ulasancount', 'koleksipribadi', 'kategoribuku', 'isKoleksi', 'buku'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Inisialisasi variabel path dengan nilai null
        $path = null;
    
        if ($request->hasFile('ImgKoleksi')) {
            // Ambil ekstensi file yang diunggah
            $extension = $request->file('ImgKoleksi')->extension();
        
            // Buat nama file baru dengan format yang Anda inginkan
            $fileName = time() .'koleksi_' . $request->NamaKoleksi .  '.' . $extension;
        
            // Simpan gambar dengan nama file kustom
            $path = $request->file('ImgKoleksi')->storeAs('koleksi/cover', $fileName, 'public');
        }
        // Buat entitas Buku dengan menggunakan path gambar yang telah disimpan
        KoleksiPribadi::create([
            'NamaKoleksi' => $request->NamaKoleksi,
            'userid' => $request->userid,
            'ImgKoleksi' => $path ? 'storage/' . $path : null, // Periksa apakah path tidak null sebelum menggunakannya
        ]);
    
        return redirect()->route('user.koleksi.show');
    }
    


    public function createcollect(Request $request, $id)
    {
        $koleksiID = KoleksiPribadi::find($id);
        $buku = $request->BukuID;
    
        // Menambahkan buku ke koleksi dengan menggunakan attach
        $koleksiID->buku()->attach($buku);
    
        return redirect()->route('koleksi.lihat', ['KoleksiID' => $koleksiID]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::all();
        $pinjamcount = Peminjaman::where('userid', Auth::id())->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $koleksiID = KoleksiPribadi::find($id);
        
        // Mengambil semua koleksi pribadi berdasarkan KoleksiID
        $koleksipribadi = KoleksiPribadi::with('user', 'buku')
            ->where('userid', Auth::id())
            ->where('KoleksiID', $id)
            ->get();
    
        $kategoribuku = KategoriBukuRelasi::all();
        
        return view('koleksi.detailkoleksi', compact('buku', 'pinjamcount', 'koleksicount', 'ulasancount', 'koleksipribadi', 'kategoribuku', 'koleksiID'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatebook(Request $request, $id)
    {
        // Temukan data koleksi berdasarkan ID
        $koleksi = KoleksiPribadi::findOrFail($id);
        
        // Ambil koleksi buku yang terkait
        $koleksiBuku = $koleksi->buku;
    
        // Perbarui BukuID dalam koleksi buku
        foreach ($koleksiBuku as $buku) {
            $buku->pivot->BukuID = $request->BukuID;
            $buku->pivot->save();
            break;
        }
    
        // Redirect ke halaman koleksi setelah pembaruan
        return redirect()->route('koleksi.lihat', ['KoleksiID' => $koleksi]);
    }
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteredirect($id)
    {
        $koleksi = KoleksiPribadi::find($id);
        $koleksi->delete();

        // Ambil BukuID dari koleksi yang dihapus
        $BukuID = $koleksi->BukuID;

        // Redirect ke halaman buku setelah update dengan menyertakan BukuID
        return redirect()->route('homepage.book.show', ['BukuID' => $BukuID]);
    }
    public function delete($id)
    {
        $koleksi = KoleksiPribadi::find($id);
        $koleksi->delete();

        // Ambil BukuID dari koleksi yang dihapus
        $BukuID = $koleksi->BukuID;

        // Redirect ke halaman buku setelah update dengan menyertakan BukuID
        return redirect()->route('user.koleksi.show', ['BukuID' => $BukuID]);
    }
    public function deletebook($id, Request $request)
    {
        // Temukan data koleksi pribadi berdasarkan ID
        $koleksi = KoleksiPribadi::findOrFail($id);
        
        // Detach buku yang terkait dengan koleksi
        $koleksi->buku()->detach($request->BukuID);
        
        return redirect()->route('koleksi.lihat', ['KoleksiID' => $id]);
    }
    

}
