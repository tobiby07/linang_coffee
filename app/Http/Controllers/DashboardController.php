<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $currentMonth = Carbon::now()->month;

        // Total pendapatan hari ini
        $totalPendapatanHariIni = Transaction::whereDate('created_at', $today)->sum('total');

        // Total pendapatan bulan ini
        $totalPendapatanBulanIni = Transaction::whereMonth('created_at', $currentMonth)->sum('total');

        // Total pengunjung transaksi hari ini
        $totalPengunjungHariIni = Transaction::whereDate('created_at', $today)->count();

        // Flow pendapatan per minggu
        $pendapatanPerMinggu = Transaction::selectRaw('WEEK(created_at) as week, SUM(total) as total')
            ->groupBy('week')
            ->get();

        // Flow pendapatan per bulan
        $pendapatanPerBulan = Transaction::selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->get();

        return view('dashboard', compact(
            'totalPendapatanHariIni', 
            'totalPendapatanBulanIni', 
            'totalPengunjungHariIni', 
            'pendapatanPerMinggu', 
            'pendapatanPerBulan'
        ));
    }
}
