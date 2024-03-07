<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriBuku::all();
        return view('dashboard.kategori', compact(['kategori']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        KategoriBuku::create([
            'KategoriID' => $request->KategoriID,
            'NamaKategori' => $request->NamaKategori,
        ]);
        // dd($request);

        // $request->session()->flash('success', 'Pesanan berhasil ditambahkan.');

        return redirect()->route('kategori.index');
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
        $kategori = KategoriBuku::find($id);
        $kategori->update($request->all());
    
        // $request->session()->flash('success', 'Pesanan berhasil diubah.');
    
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $kategori = KategoriBuku::find($id);
        $kategori->delete();
        

        return redirect()->route('kategori.index');
        // ->with('success', 'Pesanan berhasil dihapus.');
    }
}
