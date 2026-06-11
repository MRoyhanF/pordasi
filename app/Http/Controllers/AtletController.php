<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Stable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtletController extends Controller
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

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $kabupatanIds = $this->getAdminKabupatanIds();
            $stableIds = Stable::whereIn('idKabupaten', $kabupatanIds)->pluck('id');
            $atlet = Atlet::with('stable.kabupaten')->whereIn('idStable', $stableIds)->get();
        } else {
            $atlet = Atlet::with('stable.kabupaten')->get();
        }

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

        $stable = Stable::findOrFail($validated['idStable']);
        abort_if(!$this->canManageStable($stable), 403);

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

        $stable = Stable::findOrFail($validated['idStable']);
        abort_if(!$this->canManageStable($stable), 403);

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
        $stable = Stable::findOrFail($atlet->idStable);
        abort_if(!$this->canManageStable($stable), 403);
        $atlet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil dihapus',
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
