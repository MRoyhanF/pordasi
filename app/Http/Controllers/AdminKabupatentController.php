<?php

namespace App\Http\Controllers;

use App\Models\AdminKabupaten;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminKabupatentController extends Controller
{
    /**
     * Get users list for create modal
     */
    // public function getUsers($kabupatanId)
    // {
    //     try {
    //         Kabupaten::findOrFail($kabupatanId);
            
    //         // Get users that are not already admin for this kabupaten
    //         $existingAdmins = AdminKabupaten::where('idKabupaten', $kabupatanId)->where('deleted_at', null)->pluck('idUser')->toArray();
    //         $users = User::whereNotIn('id', $existingAdmins)->get(['id', 'name', 'email'])->where('deleted_at', null);

    //         return response()->json(['users' => $users]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Kabupaten tidak ditemukan'], 404);
    //     }
    // }
    public function getUsers($kabupatenId)
{
    try {
        Kabupaten::findOrFail($kabupatenId);

        // Ambil user yang belum menjadi admin kabupaten
        $existingAdmins = AdminKabupaten::where('idKabupaten', $kabupatenId)
            ->whereNull('deleted_at')
            ->pluck('idUser')
            ->toArray();

        $users = User::whereNotIn('id', $existingAdmins)
            ->whereNull('deleted_at')
            ->get(['id', 'name', 'email']);

        return response()->json([
            'users' => $users
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Kabupaten tidak ditemukan'
        ], 404);
    }
}

    /**
     * Store new admin for kabupaten (AJAX)
     */
    public function store(Request $request, $kabupatanId)
    {
        try {
            $kabupaten = Kabupaten::findOrFail($kabupatanId);

            $validated = $request->validate([
                'idUser' => 'required|exists:users,id|unique:admin_kabupaten,idUser,NULL,id,idKabupaten,' . $kabupatanId,
                'isActive' => 'boolean',
            ], [
                'idUser.required' => 'User harus dipilih',
                'idUser.exists' => 'User tidak ditemukan',
                'idUser.unique' => 'User sudah menjadi admin untuk kabupaten ini',
            ]);

            $validated['idKabupaten'] = $kabupatanId;
            $validated['isActive'] = $request->has('isActive') ? 1 : 0;

            $admin = AdminKabupaten::create($validated);
            $admin->load('user');

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil ditambahkan',
                'admin' => $admin
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()['idUser'][0] ?? 'Validasi gagal'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Get admin data for edit modal
     */
    public function getAdmin($kabupatanId, $userId)
    {
        try {
            Kabupaten::findOrFail($kabupatanId);
            $admin = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->with('user')
                ->firstOrFail();

            return response()->json(['admin' => $admin]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Admin tidak ditemukan'], 404);
        }
    }

    /**
     * Update admin (AJAX)
     */
    public function update(Request $request, $kabupatanId, $userId)
    {
        try {
            $kabupaten = Kabupaten::findOrFail($kabupatanId);
            
            // Check if admin exists
            $adminExists = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->exists();
            
            if (!$adminExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin tidak ditemukan'
                ], 404);
            }

            $validated = $request->validate([
                'isActive' => 'boolean',
            ]);

            $validated['isActive'] = $request->has('isActive') ? 1 : 0;

            // Use query builder for update to handle composite key properly
            AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Delete admin from kabupaten (AJAX)
     */
    public function destroy($kabupatanId, $userId)
    {
        try {
            $kabupaten = Kabupaten::findOrFail($kabupatanId);
            
            // Check if admin exists
            $adminExists = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->exists();
            
            if (!$adminExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin tidak ditemukan'
                ], 404);
            }

            $currentDate = now()->toDateTimeString();

            // Use query builder for delete to handle composite key properly
            AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->update(['deleted_at' => $currentDate]);

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 422);
        }
    }
}
