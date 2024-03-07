<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use Carbon\Carbon;

class CheckExpiredPeminjaman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'peminjaman:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update expired peminjaman status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Mendapatkan semua peminjaman yang masih aktif dan sudah melewati tanggal pengembalian
        $expiredPeminjaman = Peminjaman::where('StatusPeminjaman', 'Masa Aktif')
            ->whereDate('TanggalPengembalian', '<', Carbon::now()->subDays(14)->toDateString())
            ->get();

        // Mengubah status peminjaman menjadi Kedaluwarsa
        foreach ($expiredPeminjaman as $peminjaman) {
            $peminjaman->StatusPeminjaman = 'Kedaluwarsa';
            $peminjaman->save();
        }

        $this->info('Expired peminjaman checked and updated successfully.');
        return Command::SUCCESS;
    }
}
