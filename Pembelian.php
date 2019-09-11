<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelPembelian;
use App\ModelBarang;
use Validator;

class Pembelian extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //public function __construct(){
       //$this->middleware('cek_login');
     //}
    public function index()
    {
        //
        //echo "HALO SAYA ISTRINYA PARK WOOJIN";
        //return view('index');
        $data = ModelPembelian::all();
        //return view('kontak', compact('data'));
        return view('pembelian', compact('data'));
        //return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ModelBarang::all();
        return view('pembelian_create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'kd_barang' => 'required',
          'jumlah' => 'required',
          'total_harga' => 'required',
        ]);

        //ini yang menambah data pembelian
        $data = new ModelPembelian();
        $data->kd_barang = $request->kd_barang;
        $data->jumlah = $request->jumlah;
        $data->total_harga = $request->total_harga;
        $data->save();

        //ini merupakan data dari controller barang
        $databeli = ModelBarang::where('kd_barang', $request->kd_barang)->first();
        //x = x - 1;
        $databeli->stok = $databeli->stok + $request->jumlah;
        $databeli->save();

        return redirect()->route('pembelian.index')->with('alert_message', 'Berhasil menambah data!');
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
        $data = ModelPembelian::where('id', $id)->get();
        return view('pembelian_edit', compact('data'));
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
      $this->validate($request, [
        'kd_barang' => 'required',
        'jumlah' => 'required',
        'total_harga' => 'required',
      ]);

      $data = ModelPembelian::where('id', $id)->first();
      $data->kd_barang = $request->kd_barang;
      $data->jumlah = $request->jumlah;
      $data->total_harga = $request->total_harga;
      $data->save();

      return redirect()->route('pembelian.index')->with('alert_message', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ModelPembelian::where('id', $id)->first();
        $data->delete();

        return redirect()->route('pembelian.index')->with('alert_message', 'Berhasil menghapus data!');
    }
}
