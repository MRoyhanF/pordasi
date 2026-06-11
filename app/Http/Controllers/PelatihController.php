<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\Stable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelatihController extends Controller
{
    private function getAdminKabupatanIds()
    {
        return DB::table('admin_kabupaten')
            ->where('idUser', auth()->id())
            ->where('isActive', true)
            ->pluck('idKabupaten')
            ->toArray();
    }

    private function canManageStable($stableId)
    {
        $user = auth()->user();
        if ($user->role === 'SuperAdmin') return true;
        if ($user->role === 'Admin') {
            $stable = Stable::findOrFail($stableId);
            return in_array($stable->idKabupaten, $this->getAdminKabupatanIds());
        }
        return false;
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $kabupatanIds = $this->getAdminKabupatanIds();
            $stableIds = \App\Models\Stable::whereIn('idKabupaten', $kabupatanIds)->pluck('id');
            $pelatih = Pelatih::with(['user', 'stable.kabupaten'])->whereIn('stableId', $stableIds)->get();
        } else {
            $pelatih = Pelatih::with(['user', 'stable.kabupaten'])->get();
        }

        return view('pelatih.index', [
            'title' => 'Data Pelatih',
            'pelatih' => $pelatih,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userId'   => 'required|exists:users,id',
            'stableId' => 'required|exists:stable,id',
            'isActive' => 'boolean',
            'level'    => 'nullable|in:pelopor,jelajah,sigap,utama,lainnya',
        ], [
            'userId.required'   => 'Pengguna harus dipilih',
            'userId.exists'     => 'Pengguna tidak ditemukan',
            'stableId.required' => 'Stable harus dipilih',
            'stableId.exists'   => 'Stable tidak ditemukan',
            'level.in'          => 'Level tidak valid',
        ]);

        abort_if(!$this->canManageStable($validated['stableId']), 403);

        $exists = Pelatih::where('userId', $validated['userId'])
            ->where('stableId', $validated['stableId'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Pelatih sudah terdaftar di stable ini',
            ], 422);
        }

        $validated['isActive'] = $request->boolean('isActive', true);

        $pelatih = Pelatih::create($validated);
        $pelatih->load(['user', 'stable.kabupaten']);

        return response()->json([
            'success' => true,
            'message' => 'Pelatih berhasil ditambahkan',
            'pelatih' => $pelatih,
        ]);
    }

    public function update(Request $request, $userId, $stableId)
    {
        $validated = $request->validate([
            'stableId' => 'required|exists:stable,id',
            'isActive' => 'boolean',
            'level'    => 'nullable|in:pelopor,jelajah,sigap,utama,lainnya',
        ], [
            'stableId.required' => 'Stable harus dipilih',
            'stableId.exists'   => 'Stable tidak ditemukan',
            'level.in'          => 'Level tidak valid',
        ]);

        $newStableId = $validated['stableId'];
        $isActive    = $request->boolean('isActive', true);
        $level       = $validated['level'] ?? null;

        abort_if(!$this->canManageStable($stableId), 403);
        if ((string) $newStableId !== (string) $stableId) {
            abort_if(!$this->canManageStable($newStableId), 403);
        }

        // stableId changed — check duplicate then swap records
        if ((string) $newStableId !== (string) $stableId) {
            $exists = Pelatih::where('userId', $userId)
                ->where('stableId', $newStableId)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pelatih sudah terdaftar di stable ini',
                ], 422);
            }

            Pelatih::where('userId', $userId)->where('stableId', $stableId)->delete();

            $pelatih = Pelatih::create([
                'userId'   => $userId,
                'stableId' => $newStableId,
                'isActive' => $isActive,
                'level'    => $level,
            ]);
        } else {
            Pelatih::where('userId', $userId)
                ->where('stableId', $stableId)
                ->update(['isActive' => $isActive, 'level' => $level]);

            $pelatih = Pelatih::where('userId', $userId)
                ->where('stableId', $stableId)
                ->firstOrFail();
        }

        $pelatih->load(['user', 'stable.kabupaten']);

        return response()->json([
            'success' => true,
            'message' => 'Pelatih berhasil diperbarui',
            'pelatih' => $pelatih,
        ]);
    }

    public function destroy($userId, $stableId)
    {
        abort_if(!$this->canManageStable($stableId), 403);

        $deleted = Pelatih::where('userId', $userId)
            ->where('stableId', $stableId)
            ->delete();

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelatih tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pelatih berhasil dihapus',
        ]);
    }

    public function getUsers()
    {
        $users = User::all(['id', 'name', 'email']);
        return response()->json($users);
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
