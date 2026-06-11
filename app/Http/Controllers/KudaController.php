<?php

namespace App\Http\Controllers;

use App\Models\Kuda;
use App\Models\Stable;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KudaController extends Controller
{
    public function index(Request $request)
    {
        $kuda = Kuda::with('stableData.kabupaten')->get();

        return view('kuda.index', [
            'title' => 'Data Kuda',
            'kuda' => $kuda,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stable' => 'required|exists:stable,id',
            'nama'   => 'required|string|max:255',
            'pasport'  => 'nullable|string|max:255',
            'prestasi' => 'nullable|string',
            'pemilik'  => 'nullable|string|max:255',
        ], [
            'stable.required' => 'Stable harus dipilih',
            'stable.exists'   => 'Stable tidak ditemukan',
            'nama.required'   => 'Nama kuda harus diisi',
        ]);

        $kuda = Kuda::create($validated);
        $kuda->load('stableData.kabupaten');

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil ditambahkan',
            'kuda'    => $kuda,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kuda = Kuda::findOrFail($id);

        $validated = $request->validate([
            'stable' => 'required|exists:stable,id',
            'nama'   => 'required|string|max:255',
            'pasport'  => 'nullable|string|max:255',
            'prestasi' => 'nullable|string',
            'pemilik'  => 'nullable|string|max:255',
        ], [
            'stable.required' => 'Stable harus dipilih',
            'stable.exists'   => 'Stable tidak ditemukan',
            'nama.required'   => 'Nama kuda harus diisi',
        ]);

        $kuda->update($validated);
        $kuda->load('stableData.kabupaten');

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil diperbarui',
            'kuda'    => $kuda,
        ]);
    }

    public function destroy($id)
    {
        $kuda = Kuda::findOrFail($id);
        $kuda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil dihapus',
        ]);
    }

    public function getStable()
    {
        $stables = Stable::with('kabupaten')->get(['id', 'nama', 'idKabupaten']);
        return response()->json($stables);
    }
}
