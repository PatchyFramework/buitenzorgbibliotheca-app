<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBukuRelasi;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
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
        $ulasan = UlasanBuku::with('user', 'buku')
            ->where('userid', Auth::id())
            ->get();
        $kategoribuku = KategoriBukuRelasi::all();
    
        // Mengambil semua BukuID dari koleksi pribadi
        $bukuIDs = $ulasan->pluck('BukuID')->toArray();
    
        // Memeriksa apakah BukuID dari koleksi pribadi ada dalam tabel KoleksiPribadi
        $isUlasan = KoleksiPribadi::where('userid', Auth::id())
            ->exists();
        
        $koleksi = KoleksiPribadi::where('userid', Auth::id())
        ->first();
    
        return view('ulasan.ulasan', compact('pinjamcount', 'koleksicount', 'ulasancount', 'ulasan', 'kategoribuku', 'isUlasan', 'koleksi', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        UlasanBuku::create([
            'userid' => $request->userid,
            'BukuID' => $request->BukuID,
            'Ulasan' => $request->Ulasan,
            'Rating' => $request->Rating,
        ]);
    
        return redirect()->route('user.ulasan.show');
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
        //
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
    public function update(Request $request, $id)
    {
        // Temukan data buku berdasarkan ID
        $ulasan = UlasanBuku::find($id);
    
        // Update data tanpa mengubah gambar
        $ulasan->update($request->all());
        
    
        // Redirect ke halaman buku setelah update
        return redirect()->route('user.ulasan.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $ulasan = UlasanBuku::find($id);
        $ulasan->delete();
        

        // Redirect ke halaman buku setelah update
        return redirect()->route('user.ulasan.show');
    }
}
