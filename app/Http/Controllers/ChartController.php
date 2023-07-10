<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Coupon;
use App\Customer;
use App\Transaction;
use App\User;
use App\CompanyProfile;
use App\Laba;

class ChartController extends Controller
{
    public function getChartData(Request $request)
    {
        $selectedMonth = $request->input('month');

        // Lakukan query berdasarkan bulan yang dipilih
        $transaction = Transaction::whereMonth('created_at', $selectedMonth)
            ->where('valid', true)
            ->get();
        $profit = $transaction->sum('grand_total');
        $totalPengeluaran = Laba::whereMonth('tgl', $selectedMonth)->sum('jumlah');
        $sisaKeuntungan = $profit - $totalPengeluaran;

        // Formatkan data sesuai dengan format yang diharapkan
        $chartData = [
            $totalPengeluaran,
            $profit,
            $sisaKeuntungan,
        ];

        return response()->json($chartData);
    }
}
