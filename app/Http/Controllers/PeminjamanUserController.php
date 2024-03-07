<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBukuRelasi;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanUserController extends Controller
{
    public function index() {
        $pinjamcount = Peminjaman::where('StatusPeminjaman', 'Masa Aktif')
            ->where('userid', Auth::id())
            ->count();

        $user = User::all();
        $buku = Buku::all();

        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();

        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();

        $peminjaman = Peminjaman::with('user', 'buku')
            ->where('userid', Auth::id())
            ->get();

        $peminjamanaktif = Peminjaman::with('user', 'buku')
            ->where('StatusPeminjaman', 'Masa Aktif')
            ->where('userid', Auth::id())
            ->get();


        $peminjamankedaluwarsa = Peminjaman::with('user', 'buku')
            ->where('StatusPeminjaman', 'Kedaluwarsa')
            ->where('userid', Auth::id())
            ->get();

        $peminjamandikembalikan = Peminjaman::with('user', 'buku')
            ->where('StatusPeminjaman', 'Dikembalikan')
            ->where('userid', Auth::id())
            ->get();

        $kategoribuku = KategoriBukuRelasi::all();

        return view('peminjaman.peminjaman', compact('pinjamcount', 'koleksicount', 'ulasancount', 'kategoribuku', 'peminjaman', 'peminjamanaktif', 'peminjamankedaluwarsa', 'peminjamandikembalikan', 'user', 'buku'));
    }


    public function create(Request $request)
    {
        // Ambil id pengguna yang sedang login
        $userid = Auth::id();
        $buku = Buku::find($request->BukuID);

        if($buku->Stock != 0) {
            // Tambahkan data peminjaman dengan nilai userid dan BukuID yang sesuai
            Peminjaman::create([
                'userid' => $userid,
                'BukuID' => $request->BukuID,
                'TanggalPeminjaman' => $request->TanggalPeminjaman,
                'TanggalPengembalian' => $request->TanggalPengembalian,
                'StatusPeminjaman' => 'Masa Aktif',
            ]);

            if ($buku) {
                // Jika buku ditemukan, kurangi stoknya
                $buku->Stock -= 1;
                $buku->save();
            }

            return redirect()->route('user.peminjaman.show');
        } else {
            return redirect()->route('user.peminjaman.show');
        }
    }

    // public function hitungTanggalPengembalian(Request $request)
    // {
    //     // Ambil tanggal peminjaman dari request
    //     $tanggalPeminjaman = $request->input('tanggalPeminjaman');

    //     // Hitung tanggal pengembalian (misalnya, tambahkan 14 hari)
    //     $tanggalPengembalian = date('Y-m-d\TH:i', strtotime($tanggalPeminjaman . ' +14 days'));

    //     // Kembalikan tanggal pengembalian sebagai respons JSON
    //     return response()->json(['tanggalPengembalian' => $tanggalPengembalian]);
    // }


    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update($request->all());

        // $request->session()->flash('success', 'Pesanan berhasil diubah.');

        return redirect()->route('peminjaman.index');
    }

    public function delete($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();


        return redirect()->route('peminjaman.index');
        // ->with('success', 'Pesanan berhasil dihapus.');
    }
}
