<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data dummy agar blade tidak error
        $pelanggan = (object)[
            'id' => '',
            'foto' => null,
            'nama_pelanggan' => '',
            'email' => '',
            'no_telp' => '',
            'katakunci' => '',
            'alamat1' => '',
            'kota1' => '',
            'propinsi1' => '',
            'kodepos1' => '',
            'alamat2' => '',
            'kota2' => '',
            'propinsi2' => '',
            'kodepos2' => '',
            'alamat3' => '',
            'kota3' => '',
            'propinsi3' => '',
            'kodepos3' => '',
            'url_ktp' => '',
        ];

        return view('fe.profile.index', [
            'title' => 'Profile',
            'pelanggan' => $pelanggan,
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
