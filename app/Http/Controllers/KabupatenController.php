<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of all kabupaten with statistics
     */
    public function index(Request $request)
    {
        $query = Kabupaten::query();

        // // Search filter
        // if ($request->filled('search')) {
        //     $search = $request->input('search');
        //     $query->where('name', 'like', "%{$search}%");
        // }

        // // Get all data without pagination (DataTables handles pagination client-side)
        // $kabupaten = $query->get();


        $kabupaten = Kabupaten::all();

        return view('kabupaten.index', [
            'title' => 'Data Kabupaten/Kota',
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Store a newly created kabupaten in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:kabupaten,name',
        ], [
            'name.required' => 'Nama kabupaten/kota harus diisi',
            'name.unique' => 'Nama kabupaten/kota sudah terdaftar',
            'name.max' => 'Nama kabupaten/kota maksimal 255 karakter',
        ]);

        Kabupaten::create($validated);

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil ditambahkan');
    }

    /**
     * Show details for specific kabupaten
     */
    public function show($id)
    {
        $kabupaten = Kabupaten::with(['stables.atlets', 'stables.pelatih', 'adminKabupaten.user'])
            ->findOrFail($id);

        $stats = $kabupaten->getStats();

        return view('kabupaten.show', [
            'title' => 'Detail ' . $kabupaten->name,
            'kabupaten' => $kabupaten,
            'stats' => $stats,
        ]);
    }

    /**
     * Show edit form for kabupaten
     */
    public function edit($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        return view('kabupaten.edit', [
            'title' => 'Edit ' . $kabupaten->name,
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Update kabupaten in database
     */
    public function update(Request $request, $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:kabupaten,name,' . $id,
        ], [
            'name.required' => 'Nama kabupaten/kota harus diisi',
            'name.unique' => 'Nama kabupaten/kota sudah terdaftar',
            'name.max' => 'Nama kabupaten/kota maksimal 255 karakter',
        ]);

        $kabupaten->update($validated);

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil diperbarui');
    }

    /**
     * Delete kabupaten from database
     */
    public function destroy($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->delete();

        // Check if request expects JSON response
        if (request()->expectsJson() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kabupaten berhasil dihapus'
            ]);
        }

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil dihapus');
    }
}
