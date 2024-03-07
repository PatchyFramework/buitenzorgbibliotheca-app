<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\KategoriBukuRelasi;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $buku = Buku::all();
        $peminjaman = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->get();

        // Mengecek dan mengupdate status peminjaman yang sudah melewati tanggal pengembalian
        foreach ($peminjaman as $p) {
            $tanggalPengembalian = Carbon::parse($p->TanggalPengembalian);
            if (Carbon::now()->greaterThanOrEqualTo($tanggalPengembalian) && $p->StatusPeminjaman == 'Masa Aktif') {
                $p->StatusPeminjaman = 'Kedaluwarsa';
                $p->save();
            }
        }


        return view('dashboard.peminjaman', compact(['user', 'buku', 'peminjaman']));
    }

    public function indexkedaluwarsa()
    {
        $user = User::all();
        $buku = Buku::all();
        $peminjaman = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Kedaluwarsa')
        ->get();

        // Mengecek dan mengupdate status peminjaman yang sudah melewati tanggal pengembalian
        foreach ($peminjaman as $p) {
            $tanggalPengembalian = Carbon::parse($p->TanggalPengembalian);
            if (Carbon::now()->greaterThanOrEqualTo($tanggalPengembalian) && $p->StatusPeminjaman == 'Masa Aktif') {
                $p->StatusPeminjaman = 'Kedaluwarsa';
                // Menghitung jumlah hari keterlambatan
                $keterlambatan = Carbon::now()->diffInDays($tanggalPengembalian);
                // Menghitung denda (misalnya 10.000 per hari keterlambatan)
                $denda = $keterlambatan * 10000; // Ganti 10000 dengan nilai denda per hari yang sesuai
                $p->Denda = $denda;
                $p->save();
            }
        }



        return view('dashboard.peminjaman', compact(['user', 'buku', 'peminjaman']));
    }

    public function indexdikembalikan()
    {
        $user = User::all();
        $buku = Buku::all();
        $peminjaman = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Dikembalikan')
        ->get();

        // Mengecek dan mengupdate status peminjaman yang sudah melewati tanggal pengembalian
        foreach ($peminjaman as $p) {
            $tanggalPengembalian = Carbon::parse($p->TanggalPengembalian);
            if (Carbon::now()->greaterThanOrEqualTo($tanggalPengembalian) && $p->StatusPeminjaman == 'Masa Aktif') {
                $p->StatusPeminjaman = 'Kedaluwarsa';
                $p->save();
            }
        }


        return view('dashboard.peminjaman', compact(['user', 'buku', 'peminjaman']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $buku = Buku::find($request->BukuID);

        if ($buku->Stock == 0) {
            return redirect()->route('peminjaman.index');
        }

        // Menambahkan peminjaman baru
        $peminjaman = Peminjaman::create([
            'PeminjamanID' => $request->PeminjamanID,
            'userid' => $request->userid,
            'BukuID' => $request->BukuID,
            'TanggalPeminjaman' => $request->TanggalPeminjaman,
            'TanggalPengembalian' => $request->TanggalPengembalian,
            'StatusPeminjaman' => 'Masa Aktif',
        ]);

        if ($buku) {
            $buku->Stock -= 1;
            $buku->save();
        }

        return redirect()->route('peminjaman.index');
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
        $peminjaman = Peminjaman::with('user', 'buku')->find($id);
        // Menggunakan BukuID untuk mencari KategoriBukuRelasi
        $kategori = KategoriBukuRelasi::with('kategoriBuku')->where('BukuID', $peminjaman->BukuID)->first();
        return view('dashboard/detailpinjam', compact(['peminjaman', 'kategori']));
    }
    public function showkedaluwarsa($id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')->find($id);

        // Periksa apakah status peminjaman adalah "Kedaluwarsa" dan apakah tanggal pengembalian sudah lewat
        if ($peminjaman->StatusPeminjaman == 'Kedaluwarsa' && Carbon::now()->greaterThanOrEqualTo($peminjaman->TanggalPengembalian)) {
            // Menghitung jumlah hari keterlambatan
            $keterlambatan = Carbon::now()->diffInDays($peminjaman->TanggalPengembalian);
            // Menghitung denda (misalnya 10.000 per hari keterlambatan)
            $denda = $keterlambatan * '10000'; // Ganti 10000 dengan nilai denda per hari yang sesuai
            // Simpan nilai denda ke dalam model Peminjaman
            $peminjaman->Denda = $denda;
            $peminjaman->save();
        }

        // Menggunakan BukuID untuk mencari KategoriBukuRelasi
        $kategori = KategoriBukuRelasi::with('kategoriBuku')->where('BukuID', $peminjaman->BukuID)->first();

        return view('dashboard/detailpinjam', compact(['peminjaman', 'kategori']));
    }

    public function showditerima($id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')->find($id);
        // Menggunakan BukuID untuk mencari KategoriBukuRelasi
        $kategori = KategoriBukuRelasi::with('kategoriBuku')->where('BukuID', $peminjaman->BukuID)->first();
        return view('dashboard/detailpinjam', compact(['peminjaman', 'kategori']));
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
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index');
    }

    public function editstatus(Request $request, $id) {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->StatusPeminjaman = 'Dikembalikan';
        $peminjaman->save();

        // Menambahkan stok buku
        $buku = Buku::find($peminjaman->BukuID);
        if ($buku) {
            // Jika buku ditemukan, tambahkan stoknya
            $buku->Stock += 1;
            $buku->save();
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dikembalikan.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();


        return redirect()->route('peminjaman.index');
        // ->with('success', 'Pesanan berhasil dihapus.');
    }
}
