<?php

namespace App\Exports;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\KategoriBukuRelasi;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class BukuExport implements FromView
{
    public function view(): View {
        $monthNow = Carbon::now()->month;
        $yearNow = Carbon::now()->year;
        
        
        return view('pdfs.laporanbooks', [
    
            'buku' => Buku::all(),
            'kategori' => KategoriBuku::all(),
            'kategorirelasi' => KategoriBukuRelasi::with(['kategoriBuku', 'buku'])
            ->whereYear('created_at', $yearNow)
            ->whereMonth('created_at', $monthNow)
            ->get(),
    
            'peminjaman' => Peminjaman::select('BukuID', DB::raw('count(*) as total_peminjaman'))
            ->whereMonth('created_at', $monthNow)
            ->groupBy('BukuID')
            ->get(),
        ]);
    }
}
