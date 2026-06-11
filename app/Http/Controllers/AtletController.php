<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Stable;
use Illuminate\Http\Request;

class AtletController extends Controller
{
    public function index()
    {
        $atlet = Atlet::with('stable.kabupaten')->get();

        return view('atlet.index', [
            'title' => 'Data Atlet',
            'atlet' => $atlet,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idStable'      => 'required|exists:stable,id',
            'nama'          => 'required|string|max:255',
            'level'         => 'required|in:Mula,Madya,Wira',
            'jenisKelamin'  => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'alamat'        => 'nullable|string|max:255',
        ], [
            'idStable.required'     => 'Stable harus dipilih',
            'idStable.exists'       => 'Stable tidak ditemukan',
            'nama.required'         => 'Nama atlet harus diisi',
            'level.required'        => 'Level harus dipilih',
            'level.in'              => 'Level tidak valid',
            'jenisKelamin.required' => 'Jenis kelamin harus dipilih',
            'jenisKelamin.in'       => 'Jenis kelamin tidak valid',
        ]);

        $atlet = Atlet::create($validated);
        $atlet->load('stable.kabupaten');

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil ditambahkan',
            'atlet'   => $atlet,
        ]);
    }

    public function update(Request $request, $id)
    {
        $atlet = Atlet::findOrFail($id);

        $validated = $request->validate([
            'idStable'      => 'required|exists:stable,id',
            'nama'          => 'required|string|max:255',
            'level'         => 'required|in:Mula,Madya,Wira',
            'jenisKelamin'  => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'alamat'        => 'nullable|string|max:255',
        ], [
            'idStable.required'     => 'Stable harus dipilih',
            'idStable.exists'       => 'Stable tidak ditemukan',
            'nama.required'         => 'Nama atlet harus diisi',
            'level.required'        => 'Level harus dipilih',
            'level.in'              => 'Level tidak valid',
            'jenisKelamin.required' => 'Jenis kelamin harus dipilih',
            'jenisKelamin.in'       => 'Jenis kelamin tidak valid',
        ]);

        $atlet->update($validated);
        $atlet->load('stable.kabupaten');

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil diperbarui',
            'atlet'   => $atlet,
        ]);
    }

    public function destroy($id)
    {
        $atlet = Atlet::findOrFail($id);
        $atlet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil dihapus',
        ]);
    }

    public function getStable()
    {
        $stables = Stable::with('kabupaten')->get(['id', 'nama', 'idKabupaten']);
        return response()->json($stables);
    }
}
