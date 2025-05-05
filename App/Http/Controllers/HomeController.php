<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisObat;
use App\Models\Obat;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.index', [
            'title' => 'Home',
            'id_jenis' => Obat::distinct()->get(['id_jenis']),
            'obats' => Obat::all(),
            'jenis_obats' => JenisObat::all()
        ]);
    }

    /**
     * Show the product page.
     */
    public function product()
    {
        $jenis_obats = JenisObat::with('obat')->get();

        return view('fe.product', [
            'title' => 'Produk Obat',
            'jenis_obats' => $jenis_obats,
            'obats' => Obat::with('jenisObat')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
