<?php

namespace App\Http\Controllers;

use App\Models\Stable;
use App\Models\Kabupaten;
use App\Models\Pelatih;
use Illuminate\Http\Request;

class PublicStableController extends Controller
{
    public function index(Request $request)
    {
        $query = Stable::with(['kabupaten', 'atlets', 'kuda']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('alamat_stable', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kabupaten')) {
            $query->where('idKabupaten', $request->kabupaten);
        }

        $stables = $query->paginate(12)->withQueryString();
        $kabupatens = Kabupaten::orderBy('name')->get();

        return view('public.stable.index', compact('stables', 'kabupatens'));
    }

    public function show(Stable $stable)
    {
        $stable->load(['kabupaten', 'atlets', 'kuda']);

        // Load pelatih manually to avoid composite key eager loading issues
        $pelatih = Pelatih::with('user')
            ->where('stableId', $stable->id)
            ->get();

        return view('public.stable.show', compact('stable', 'pelatih'));
    }
}
