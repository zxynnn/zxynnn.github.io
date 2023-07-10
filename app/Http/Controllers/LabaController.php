<?php

namespace App\Http\Controllers;

use App\Laba;
use App\Transaction;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LabaController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Akumulasi Laba";

        $items = Laba::all();

        return view('pages.laba.index', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Memperlihatkan formulir untuk membuat sumber daya baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Akumulasi pendapatan dan pengeluaran dibulan ini.";

        $transaction = Transaction::whereMonth('created_at', '=', date('m'))->where('valid', TRUE)->get();
        $profit = $transaction->sum('grand_total');
        return view('pages.laba.create', [
            'title' => $title,
            'profit' => $profit

        ]);
    }

    /**
     * Simpan sumber daya yang baru dibuat di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $photo = $request->file('photo');

        if ($photo) {
            $data['photo'] = $photo->store(
                'assets/laba',
                'public'
            );
        } else {
            $data['photo'] = "";
        }


        $data['jumlah'] = str_replace(',', '', $data['jumlah']);


        Laba::create($data);

        return redirect()->route('laba.index')->with('success', 'Akumulasi laba berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laba  $laba
     * @return \Illuminate\Http\Response
     */
    public function show(Laba $laba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laba  $laba
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Data Akumulasi Laba";

        $items = Laba::findOrFail($id);

        return view('pages.laba.edit', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laba  $laba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $photo = $request->file('photo');

        if ($photo) {
            $data['photo'] = $photo->store(
                'assets/laba',
                'public'
            );
        } else {
            $data['photo'] = "";
        }


        $data['jumlah'] = str_replace(',', '', $data['jumlah']);


        Laba::findOrFail($id)->update($data);

        return redirect()->route('laba.index')->with('success', 'Akumulasi laba berhasil dibuat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laba  $laba
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laba::findOrFail($id)->delete();

        return redirect()->route('laba.index')->with('success', 'Data berhasil dihapus!');
    }
}
