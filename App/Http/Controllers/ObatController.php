<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\JenisObat;
use Illuminate\Auth\Events\Validated;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::with('jenis_obat')->get();
        return view('be.obat.index', [
            'title' => 'Obat',
            'obats' => $obat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_obat = JenisObat::all();
        return view('be.obat.create', [
            'title' => 'Tambah Obat',
            'jenis_obat' => $jenis_obat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'id_jenis' => 'required',
            'harga_jual' => 'required|numeric',
            'deskripsi' => 'required',
            'foto1' => 'required|image|file|max:2048',
            'foto2' => 'nullable|image|file|max:2048',
            'foto3' => 'nullable|image|file|max:2048',
            'stok' => 'required|numeric'
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'id_jenis' => $request->id_jenis,
            'harga_jual' => $request->harga_jual,
            'deskripsi_obat' => $request->deskripsi,
            'foto1' => $request->file('foto1')->store('obat-images'),
            'foto2' => $request->hasFile('foto2') ? $request->file('foto2')->store('obat-images') : null,
            'foto3' => $request->hasFile('foto3') ? $request->file('foto3')->store('obat-images') : null,
            'stok' => $request->stok
        ]);

        return redirect('/obat')->with('success', 'Obat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obat = Obat::find($id);
        return view('be.obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::find($id);
        $jenis_obat = JenisObat::all();
        return view('be.obat.edit', [
            'title' => 'Edit Obat',
            'obat' => $obat,
            'jenis_obat' => $jenis_obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'jenis_obat_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            // tambahkan validasi lain jika perlu
        ]);

        $obat = Obat::findOrFail($id);
        $obat->nama_obat = $request->nama_obat;
        $obat->id_jenis = $request->jenis_obat_id;
        $obat->harga_jual = $request->harga;
        $obat->stok = $request->stok;
        // tambahkan update field lain jika ada

        $obat->save();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::find($id);
        if ($obat) {
            $obat->delete();
            return redirect('/obat')->with('success', 'Obat berhasil dihapus');
        } else {
            return redirect('/obat')->with('error', 'Obat tidak ditemukan');
        }
    }
}
