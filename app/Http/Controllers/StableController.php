<?php

namespace App\Http\Controllers;

use App\Models\Stable;
use App\Models\Kabupaten;
use App\Models\Atlet;
use App\Models\Pelatih;
use App\Models\Kuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StableController extends Controller
{
    /**
     * Check if user can manage this stable
     */
    private function canManageStable($stable)
    {
        $user = auth()->user();
        
        // SuperAdmin can manage all stables
        if ($user->role === 'SuperAdmin') {
            return true;
        }
        
        // AdminKabupaten can only manage stables in their kabupaten
        if ($user->role === 'AdminKabupaten') {
            return DB::table('admin_kabupaten')
                ->where('idUser', $user->id)
                ->where('idKabupaten', $stable->idKabupaten)
                ->exists();
        }
        
        return false;
    }

    /**
     * Display a listing of all stables with statistics
     */
    private function getAdminKabupatanIds()
    {
        return DB::table('admin_kabupaten')
            ->where('idUser', auth()->id())
            ->where('isActive', true)
            ->pluck('idKabupaten')
            ->toArray();
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $kabupatanIds = $this->getAdminKabupatanIds();
            $stables = Stable::with('kabupaten')->whereIn('idKabupaten', $kabupatanIds)->get();
        } else {
            $stables = Stable::with('kabupaten')->get();
        }

        return view('stable.index', [
            'title' => 'Data Stable',
            'stables' => $stables,
        ]);
    }

    /**
     * Store a newly created stable in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idKabupaten' => 'required|exists:kabupaten,id',
            'nama' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'alamat_stable' => 'required|string',
            'pimpinan_stable' => 'required|string|max:255',
            'mulai_berdiri' => 'nullable|digits:4|numeric|min:1900|max:' . date('Y'),
            'alamat_ktp_pemilik' => 'nullable|string',
            'no_akte_badan_hukum' => 'nullable|string|max:255',
            'no_pengesahan_kumham' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:20',
            'domisili_badan_hukum' => 'nullable|string',
            'jumlah_kandang' => 'nullable|integer|min:1',
            'frameMap' => 'nullable|string',
        ], [
            'idKabupaten.required' => 'Kabupaten harus dipilih',
            'idKabupaten.exists' => 'Kabupaten tidak ditemukan',
            'nama.required' => 'Nama stable harus diisi',
            'nama.unique' => 'Nama stable sudah terdaftar',
            'pemilik.required' => 'Nama pemilik harus diisi',
            'alamat_stable.required' => 'Alamat stable harus diisi',
            'pimpinan_stable.required' => 'Nama pimpinan stable harus diisi',
        ]);

        $stable = Stable::create($validated);
        $stable->load('kabupaten', 'atlets', 'pelatih', 'kuda');

        return response()->json([
            'success' => true,
            'message' => 'Stable berhasil ditambahkan',
            'stable' => $stable
        ]);
    }

    /**
     * Display the specified stable
     */
    public function show($id)
    {
        $stable = Stable::with('kabupaten', 'atlets', 'pelatih.user', 'kuda')->findOrFail($id);
        
        // Check authorization
        abort_if(!$this->canManageStable($stable), 403, 'Anda tidak memiliki akses ke stable ini');

        return view('stable.show', [
            'title' => 'Detail Stable - ' . $stable->nama,
            'stable' => $stable,
        ]);
    }

    /**
     * Show the form for editing the specified stable
     */
    public function edit($id)
    {
        $stable = Stable::findOrFail($id);
        
        // Check authorization
        abort_if(!$this->canManageStable($stable), 403, 'Anda tidak memiliki akses ke stable ini');

        $kabupaten = Kabupaten::all();

        return view('stable.edit', [
            'title' => 'Edit Stable - ' . $stable->nama,
            'stable' => $stable,
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Update the specified stable in database
     */
    public function update(Request $request, $id)
    {
        $stable = Stable::findOrFail($id);

        $validated = $request->validate([
            'idKabupaten' => 'required|exists:kabupaten,id',
            'nama' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'alamat_stable' => 'required|string',
            'pimpinan_stable' => 'required|string|max:255',
            'mulai_berdiri' => 'nullable|digits:4|numeric|min:1900|max:' . date('Y'),
            'alamat_ktp_pemilik' => 'nullable|string',
            'no_akte_badan_hukum' => 'nullable|string|max:255',
            'no_pengesahan_kumham' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:20',
            'domisili_badan_hukum' => 'nullable|string',
            'jumlah_kandang' => 'nullable|integer|min:1',
            'frameMap' => 'nullable|string',
        ], [
            'idKabupaten.required' => 'Kabupaten harus dipilih',
            'idKabupaten.exists' => 'Kabupaten tidak ditemukan',
            'nama.required' => 'Nama stable harus diisi',
            'pemilik.required' => 'Nama pemilik harus diisi',
            'alamat_stable.required' => 'Alamat stable harus diisi',
            'pimpinan_stable.required' => 'Nama pimpinan stable harus diisi',
        ]);

        $stable->update($validated);
        $stable->load('kabupaten', 'atlets', 'pelatih', 'kuda');

        return response()->json([
            'success' => true,
            'message' => 'Stable berhasil diperbarui',
            'stable' => $stable
        ]);
    }

    /**
     * Delete the specified stable from database
     */
    public function destroy($id)
    {
        $stable = Stable::findOrFail($id);
        $stable->delete();

        return response()->json([
            'success' => true,
            'message' => 'Stable berhasil dihapus'
        ]);
    }

    /**
     * Get all kabupaten for dropdown
     */
    public function getKabupaten()
    {
        $user = auth()->user();
        if ($user->role === 'Admin') {
            $ids = $this->getAdminKabupatanIds();
            $kabupaten = Kabupaten::whereIn('id', $ids)->get();
        } else {
            $kabupaten = Kabupaten::all();
        }
        return response()->json($kabupaten);
    }

    public function getByKabupaten($kabupatanId)
    {
        $user = auth()->user();
        if ($user->role === 'Admin') {
            $ids = $this->getAdminKabupatanIds();
            if (!in_array($kabupatanId, $ids)) {
                return response()->json([]);
            }
        }
        $stables = Stable::where('idKabupaten', $kabupatanId)->get();
        return response()->json($stables);
    }

    // ========== ATLET CRUD ==========
    
    /**
     * Store a new atlet
     */
    public function storeAtlet(Request $request, $stableId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'level' => 'required|in:Mula,Madya,Wira',
            'jenisKelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        $validated['idStable'] = $stableId;
        $atlet = Atlet::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil ditambahkan',
            'atlet' => $atlet
        ]);
    }

    /**
     * Update an atlet
     */
    public function updateAtlet(Request $request, $stableId, $atletId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        $atlet = Atlet::findOrFail($atletId);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'level' => 'required|in:Mula,Madya,Wira',
            'jenisKelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
        ]);

        $atlet->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil diperbarui',
            'atlet' => $atlet
        ]);
    }

    /**
     * Delete an atlet
     */
    public function destroyAtlet($stableId, $atletId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        Atlet::findOrFail($atletId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Atlet berhasil dihapus'
        ]);
    }

    // ========== KUDA CRUD ==========
    
    /**
     * Store a new kuda
     */
    public function storeKuda(Request $request, $stableId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pasport' => 'nullable|string|max:255',
            'prestasi' => 'nullable|string',
            'pemilik' => 'nullable|string|max:255',
        ]);

        $validated['stable'] = $stableId;
        $kuda = Kuda::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil ditambahkan',
            'kuda' => $kuda
        ]);
    }

    /**
     * Update a kuda
     */
    public function updateKuda(Request $request, $stableId, $kudaId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        $kuda = Kuda::findOrFail($kudaId);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pasport' => 'nullable|string|max:255',
            'prestasi' => 'nullable|string',
            'pemilik' => 'nullable|string|max:255',
        ]);

        $kuda->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil diperbarui',
            'kuda' => $kuda
        ]);
    }

    /**
     * Delete a kuda
     */
    public function destroyKuda($stableId, $kudaId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        Kuda::findOrFail($kudaId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kuda berhasil dihapus'
        ]);
    }

    // ========== PELATIH CRUD ==========
    
    /**
     * Get users for pelatih selection
     */
    public function getPelatihUsers($stableId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        // Get users who are not already pelatih in this stable
        $existingPelatih = Pelatih::where('stableId', $stableId)->pluck('userId')->toArray();
        $users = \App\Models\User::whereNotIn('id', $existingPelatih)->get(['id', 'name']);

        return response()->json($users);
    }

    /**
     * Store a new pelatih (link user to stable)
     */
    public function storePelatih(Request $request, $stableId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        $validated = $request->validate([
            'userId' => 'required|exists:users,id|unique:pelatih,userId,NULL,id,stableId,' . $stableId,
        ]);

        $pelatih = Pelatih::create([
            'userId' => $validated['userId'],
            'stableId' => $stableId,
            'isActive' => true,
        ]);

        $pelatih->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Pelatih berhasil ditambahkan',
            'pelatih' => $pelatih
        ]);
    }

    /**
     * Update pelatih status
     */
    public function updatePelatih(Request $request, $stableId, $userId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        $validated = $request->validate([
            'isActive' => 'required|boolean',
        ]);

        Pelatih::where('userId', $userId)
            ->where('stableId', $stableId)
            ->update(['isActive' => $validated['isActive']]);

        return response()->json([
            'success' => true,
            'message' => 'Status pelatih berhasil diperbarui'
        ]);
    }

    /**
     * Delete a pelatih
     */
    public function destroyPelatih($stableId, $userId)
    {
        $stable = Stable::findOrFail($stableId);
        abort_if(!$this->canManageStable($stable), 403);

        Pelatih::where('userId', $userId)
            ->where('stableId', $stableId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pelatih berhasil dihapus'
        ]);
    }
}
