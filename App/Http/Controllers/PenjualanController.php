<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::with(['user', 'items.product'])->latest()->get();
        return view('be.penjualan.index', compact('penjualan'));
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

    /**
     * Approve the specified penjualan.
     */
    public function approve($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->status = 'approved';
        $penjualan->save();

        return redirect()->back()->with('success', 'Penjualan berhasil disetujui');
    }

    /**
     * Reject the specified penjualan.
     */
    public function reject($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->status = 'rejected';
        $penjualan->save();

        return redirect()->back()->with('success', 'Penjualan berhasil ditolak');
    }
}
