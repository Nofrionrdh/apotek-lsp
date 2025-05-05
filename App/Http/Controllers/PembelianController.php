<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Distributor;
use App\Models\Obat;
use App\Models\JenisObat;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::with(['distributor', 'details.obat'])->get();
        return view('pembelian.index', [
            'title' => 'Pembelian',
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $distributors = Distributor::all();
        $obat = Obat::with('jenis_obat')->get();
        return view('pembelian.create', [
            'title' => 'Tambah Pembelian',
            'distributors' => $distributors,
            'obat' => $obat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_nota' => 'required|unique:pembelians',
            'tgl_pembelian' => 'required|date',
            'distributor_id' => 'required|exists:distributors,id',
            'obat_id' => 'required|array',
            'jumlah' => 'required|array',
            'harga_beli' => 'required|array',
        ]);

        $total_bayar = 0;
        for ($i = 0; $i < count($request->obat_id); $i++) {
            $subtotal = $request->jumlah[$i] * $request->harga_beli[$i];
            $total_bayar += $subtotal;
        }

        // Create main pembelian record
        $pembelian = Pembelian::create([
            'no_nota' => $request->no_nota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'id_distributor' => $request->distributor_id,
            'total_bayar' => $total_bayar
        ]);

        // Store detail pembelian records
        for ($i = 0; $i < count($request->obat_id); $i++) {
            $subtotal = $request->jumlah[$i] * $request->harga_beli[$i];
            $pembelian->details()->create([
                'id_obat' => $request->obat_id[$i],
                'jumlah_beli' => $request->jumlah[$i],
                'harga_beli' => $request->harga_beli[$i],
                'subtotal' => $subtotal
            ]);

            // Update stok obat
            $obat = Obat::find($request->obat_id[$i]);
            $obat->stok += $request->jumlah[$i];
            $obat->save();
        }

        return redirect('/pembelian')->with('success', 'Pembelian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembelian = Pembelian::with(['distributor', 'obat'])->findOrFail($id);
        return view('pembelian.show', [
            'title' => 'Detail Pembelian',
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembelian = Pembelian::with(['distributor', 'obat'])->findOrFail($id);
        $distributors = Distributor::all();
        $obat = Obat::with('jenis_obat')->get();
        return view('pembelian.edit', [
            'title' => 'Edit Pembelian',
            'pembelian' => $pembelian,
            'distributors' => $distributors,
            'obat' => $obat
        ]);
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
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();

        return redirect('/pembelian')->with('success', 'Pembelian berhasil dihapus');
    }
}
