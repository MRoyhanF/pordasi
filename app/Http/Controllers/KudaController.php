<?php

namespace App\Http\Controllers;

use App\Models\Kuda;
use App\Models\Stable;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KudaController extends Controller
{
    private function getAdminKabupatanIds()
    {
        return DB::table('admin_kabupaten')
            ->where('idUser', auth()->id())
            ->where('isActive', true)
            ->pluck('idKabupaten')
            ->toArray();
    }

    private function canManageStable($stable)
    {
        $user = auth()->user();
        if ($user->role === 'SuperAdmin') return true;
        if ($user->role === 'Admin') {
            return in_array($stable->idKabupaten, $this->getAdminKabupatanIds());
        }
        return false;
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $kabupatanIds = $this->getAdminKabupatanIds();
            $stableIds = Stable::whereIn('idKabupaten', $kabupatanIds)->pluck('id');
            $kuda = Kuda::with('stableData.kabupaten')->whereIn('stable', $stableIds)->get();
        } else {
            $kuda = Kuda::with('stableData.kabupaten')->get();
        }

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

        $stable = Stable::findOrFail($validated['stable']);
        abort_if(!$this->canManageStable($stable), 403);

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

        $stable = Stable::findOrFail($validated['stable']);
        abort_if(!$this->canManageStable($stable), 403);

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
        $stable = Stable::findOrFail($kuda->stable);
        abort_if(!$this->canManageStable($stable), 403);
        $kuda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil dihapus',
        ]);
    }

    public function getStable()
    {
        $user = auth()->user();
        if ($user->role === 'Admin') {
            $kabupatanIds = $this->getAdminKabupatanIds();
            $stables = Stable::with('kabupaten')->whereIn('idKabupaten', $kabupatanIds)->get(['id', 'nama', 'idKabupaten']);
        } else {
            $stables = Stable::with('kabupaten')->get(['id', 'nama', 'idKabupaten']);
        }
        return response()->json($stables);
    }
}
