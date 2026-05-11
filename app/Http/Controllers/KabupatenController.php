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

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $kabupaten = $query->paginate(10);

        return view('kabupaten.index', [
            'title' => 'Data Kabupaten/Kota',
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Show details for specific kabupaten
     */
    public function show($id)
    {
        $kabupaten = Kabupaten::with(['stables.atlets', 'stables.pelatih'])
            ->findOrFail($id);

        $stats = $kabupaten->getStats();

        return view('kabupaten.show', [
            'title' => 'Detail ' . $kabupaten->name,
            'kabupaten' => $kabupaten,
            'stats' => $stats,
        ]);
    }
}
