<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = session('pelanggan'); // Ambil dari session FE

        if (!$pelanggan) {
            return redirect()->route('pelanggan.login');
        }

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
        // Validasi request
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pelanggans,email,'.$id,
            'no_telp' => 'nullable|string|max:20',
            'katakunci' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat1' => 'nullable|string',
            'kota1' => 'nullable|string',
            'propinsi1' => 'nullable|string',
            'kodepos1' => 'nullable|string',
            'alamat2' => 'nullable|string',
            'kota2' => 'nullable|string',
            'propinsi2' => 'nullable|string',
            'kodepos2' => 'nullable|string',
            'alamat3' => 'nullable|string',
            'kota3' => 'nullable|string',
            'propinsi3' => 'nullable|string',
            'kodepos3' => 'nullable|string',
            'url_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Dapatkan pelanggan yang akan diupdate
        $pelanggan = Pelanggan::findOrFail($id);

        // Update data dasar
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telp = $request->no_telp;

        // Update password jika diisi
        if ($request->katakunci) {
            $pelanggan->katakundi = Hash::make($request->katakunci);
        }

        // Handle upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pelanggan->foto) {
                Storage::delete($pelanggan->foto);
            }
            
            // Simpan foto baru
            $path = $request->file('foto')->store('pelanggan/foto');
            $pelanggan->foto = $path;
        }

        // Update alamat - sesuaikan dengan nama kolom di database
        $pelanggan->alamati = $request->alamat1;
        $pelanggan->kota1 = $request->kota1;
        $pelanggan->propinsti = $request->propinsi1;
        $pelanggan->kodepos1 = $request->kodepos1;
        
        $pelanggan->alamai2 = $request->alamat2;
        $pelanggan->kota2 = $request->kota2;
        $pelanggan->propinsi2 = $request->propinsi2;
        $pelanggan->kodepos2 = $request->kodepos2;
        
        $pelanggan->alamai3 = $request->alamat3;
        $pelanggan->kota3 = $request->kota3;
        $pelanggan->propinsi3 = $request->propinsi3;
        $pelanggan->kodepos3 = $request->kodepos3;
        
        $pelanggan->url_ktp = $request->url_ktp;

        // Simpan perubahan
        $pelanggan->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
