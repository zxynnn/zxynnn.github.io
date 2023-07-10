<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Sale;
use App\Coupon;
use App\Customer;
use App\Transaction;
use App\User;
use App\CompanyProfile;
use App\Laba;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Home Page";

        $customer = Customer::all()->count();

        $items = Transaction::with([
            'customer'
        ])->where('valid', TRUE)->get();

        $transaction = Transaction::whereMonth('created_at', '=', date('m'))->where('valid', TRUE)->get();
        $profit = $transaction->sum('grand_total');
        $totalTransaction = $transaction->count();
        $totalPengeluaran = Laba::sum('jumlah');
        $sisaKeuntungan = $profit - $totalPengeluaran;


        return view('home', [
            'title' => $title,
            'customer' => $customer,
            'profit' => $profit,
            'totalPengeluaran' => $totalPengeluaran,
            'sisaKeuntungan' => $sisaKeuntungan,
            'totalTransaction' => $totalTransaction,
            'items' => $items

        ]);

    }


    
    
}
