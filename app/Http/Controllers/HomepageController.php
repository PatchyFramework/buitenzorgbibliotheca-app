<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\KategoriBukuRelasi;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $ulasan = UlasanBuku::all();
        $ulasantrending = UlasanBuku::select('BukuID', DB::raw('SUM(Rating) as total_rating'))
        ->groupBy('BukuID')
        ->orderByDesc('total_rating')
        ->get();
        $kategoribuku = KategoriBukuRelasi::all();

        // dd($ulasan);

        return view('homepage.homepage', compact(['buku', 'kategoribuku', 'pinjamcount', 'koleksicount', 'ulasancount', 'ulasan', 'ulasantrending']));
    }
    public function indexbuku()
    {
        $buku = Buku::all();
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $ulasan = UlasanBuku::all();
        $kategoribuku = KategoriBukuRelasi::all();


        return view('homepage.buku', compact(['buku', 'kategoribuku', 'pinjamcount', 'koleksicount', 'ulasancount', 'ulasan']));
    }
    public function indexkategori()
    {
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $kategoribuku = KategoriBuku::all();
        $buku = Buku::all();


        return view('homepage.kategori', compact(['kategoribuku', 'pinjamcount', 'koleksicount', 'ulasancount', 'buku']));
    }

    public function showkategori($id)
    {
        $buku = Buku::all();
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $ulasan = UlasanBuku::all();
        $kategoribuku = KategoriBukuRelasi::where('KategoriID', $id)->get();
        $category = KategoriBuku::find($id);


        return view('homepage.hasilkategori', compact(['buku', 'kategoribuku', 'pinjamcount', 'koleksicount', 'ulasancount', 'ulasan', 'category']));
    }

    public function sortBuku(Request $request)
    {
        $sortOption = $request->input('sort');

        switch ($sortOption) {
            case 'title_asc':
                $buku = Buku::orderBy('Judul')->get();
                break;
            case 'title_desc':
                $buku = Buku::orderByDesc('Judul')->get();
                break;
            case 'latest':
                $buku = Buku::orderByDesc('created_at')->get();
                break;
            case 'oldest':
                $buku = Buku::orderBy('created_at')->get();
                break;
            default:
                $buku = Buku::all();
        }

        return response()->json($buku);
    }


    public function show($id)
    {
        $buku = Buku::find($id);
        $rekomendasi = Buku::where('Penulis', $buku->Penulis)->get();
        $koleksi = KoleksiPribadi::where('userid', Auth::id())->get();
        $ulasanbuku = UlasanBuku::where('BukuID', $id)->get();
        $detailbuku = KategoriBukuRelasi::with('buku', 'kategoriBuku')->find($buku->BukuID);
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $isKoleksi = KoleksiPribadi::where('userid', Auth::id())->exists();
        $koleksiIDs = $koleksi->pluck('KoleksiID');

        $koleksipribadi = KoleksiPribadi::with('user', 'buku')
            ->where('userid', Auth::id())
            ->whereIn('KoleksiID', $koleksiIDs)
            ->get();

        // dd($buku);

        if ($buku !== null) {
            // Jika buku ditemukan, maka akses properti Stock
            $stock = $buku->Stock;
            if ($buku->StatusKetersediaan == 'Tersedia' && $stock == 0) {
                $buku->StatusKetersediaan = 'Tidak Tersedia';
                $buku->save();
            }
            if ($buku->StatusKetersediaan == 'Tidak Tersedia' && $stock != 0) {
                $buku->StatusKetersediaan = 'Tersedia';
                $buku->save();
            }
        }



        return view('homepage.detailbuku', compact('detailbuku', 'pinjamcount', 'koleksi', 'koleksicount', 'isKoleksi' , 'ulasancount', 'buku', 'koleksipribadi', 'ulasanbuku', 'rekomendasi'));
    }



    public function showprofile($id)
    {
        $user = User::find($id);
        $buku = Buku::find($id);
        $detailbuku = Peminjaman::with('user', 'buku')
        ->where('userid', $id)
        ->get();
        $koleksipribadi = KoleksiPribadi::with('user', 'buku')
        ->where('userid', $id)
        ->get();
        $ulasanbuku = UlasanBuku::with('user', 'buku')
        ->where('userid', $id)
        ->get();
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();

        return view('profile.profile', compact('user', 'buku', 'detailbuku', 'koleksipribadi', 'ulasanbuku', 'pinjamcount', 'koleksicount', 'ulasancount'));
    }

    public function updateprofile(Request $request, $id)
    {
        // Temukan data pengguna berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            // Jika pengguna tidak ditemukan, kembalikan respons yang sesuai
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah ada file baru diunggah
        if ($request->hasFile('imguser')) {
            // Hapus gambar lama jika ada dan bukan null
            if ($user->imguser) {
                Storage::disk('public')->delete($user->imguser);
            }

            // Proses file gambar baru
            $fileName = $request->file('imguser')->getClientOriginalName();
            $path = $request->file('imguser')->storeAs('user/photos', $fileName, 'public');
            $user->imguser = 'storage/' . $path;
        }

        // Update data tanpa mengubah gambar
        $user->update($request->except('imguser'));

        // Redirect ke halaman profil setelah update
        return redirect()->route('profile.show', ['userid' => Auth::id()]);
    }

    public function searchbuku(Request $request)
    {
        $pinjamcount = Peminjaman::with('user', 'buku')
        ->where('StatusPeminjaman', 'Masa Aktif')
        ->where('userid', Auth::id())
        ->count();
        $koleksicount = KoleksiPribadi::where('userid', Auth::id())->count();
        $ulasancount = UlasanBuku::where('userid', Auth::id())->count();
        $kategoribuku = KategoriBukuRelasi::all();


        $search = $request->input('search');
        $results = Buku::where('Barcode', 'like', "%$search%")
                        ->orWhere('Judul', 'like', "%$search%")
                        ->get();

        return view('homepage.search', compact('pinjamcount', 'koleksicount', 'ulasancount', 'results', 'kategoribuku', 'search'));
    }


    public function read()
    {
        return view('epub.epub');
    }
}
