<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\Stable;
use App\Models\User;
use Illuminate\Http\Request;

class PelatihController extends Controller
{
    public function index(Request $request)
    {
        $pelatih = Pelatih::with(['user', 'stable.kabupaten'])->get();

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
        ], [
            'userId.required'   => 'Pengguna harus dipilih',
            'userId.exists'     => 'Pengguna tidak ditemukan',
            'stableId.required' => 'Stable harus dipilih',
            'stableId.exists'   => 'Stable tidak ditemukan',
        ]);

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
        ], [
            'stableId.required' => 'Stable harus dipilih',
            'stableId.exists'   => 'Stable tidak ditemukan',
        ]);

        $newStableId = $validated['stableId'];
        $isActive    = $request->boolean('isActive', true);

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
            ]);
        } else {
            Pelatih::where('userId', $userId)
                ->where('stableId', $stableId)
                ->update(['isActive' => $isActive]);

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
        $users = User::where('role', 'Pelatih')->get(['id', 'name', 'email']);
        return response()->json($users);
    }

    public function getStable()
    {
        $stables = Stable::with('kabupaten')->get(['id', 'nama', 'idKabupaten']);
        return response()->json($stables);
    }
}
