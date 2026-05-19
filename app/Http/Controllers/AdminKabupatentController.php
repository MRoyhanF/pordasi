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
            // SoftDeletes trait otomatis exclude deleted records
            $existingAdmins = AdminKabupaten::where('idKabupaten', $kabupatenId)
                ->pluck('idUser')
                ->toArray();

            $users = User::whereNotIn('id', $existingAdmins)
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

    public function store(Request $request, $kabupatanId)
    {
        try {
            $kabupaten = Kabupaten::findOrFail($kabupatanId);

            $validated = $request->validate([
                'idUser' => [
                    'required',
                    'exists:users,id',
                    // Custom unique rule untuk soft delete
                    function ($attribute, $value, $fail) use ($kabupatanId) {
                        $exists = AdminKabupaten::where('idKabupaten', $kabupatanId)
                            ->where('idUser', $value)
                            ->whereNull('deleted_at')
                            ->exists();
                        
                        if ($exists) {
                            $fail('User sudah menjadi admin untuk kabupaten ini');
                        }
                    }
                ],
                'isActive' => 'boolean',
            ], [
                'idUser.required' => 'User harus dipilih',
                'idUser.exists' => 'User tidak ditemukan',
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
            
            // Query untuk menemukan admin - gunakan query builder untuk lebih flexible
            $admin = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->with('user')
                ->first(); // Gunakan first() instead of firstOrFail()

            if (!$admin) {                
                // Check jika ada di deleted_at (soft deleted)
                $deleted = AdminKabupaten::withTrashed()
                    ->where('idKabupaten', $kabupatanId)
                    ->where('idUser', $userId)
                    ->first();
                
                if ($deleted && $deleted->deleted_at) {
                    return response()->json([
                        'error' => 'Admin ini telah dihapus',
                        'details' => 'Admin sudah dalam status terhapus'
                    ], 410); // 410 Gone
                }
                
                return response()->json([
                    'error' => 'Admin tidak ditemukan',
                    'details' => 'Kombinasi admin dan kabupaten tidak valid'
                ], 404);
            }

            return response()->json([
                'admin' => $admin,
                'success' => true
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Kabupaten tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan pada server',
                'details' => $e->getMessage()
            ], 500);
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
            $admin = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->first();
            
            if (!$admin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin tidak ditemukan'
                ], 404);
            }
            // Validate
            $validated = $request->validate([
                'isActive' => 'in:0,1',  // Accept "0" or "1" as strings
            ], [
                'isActive.in' => 'Status harus 0 atau 1'
            ]);
            // Convert to int
            $validated['isActive'] = (int)$validated['isActive'];
            
            // Use query builder for update to handle composite key properly
            $updated = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->update($validated);
            
            // Verify update
            $adminAfter = AdminKabupaten::where('idKabupaten', $kabupatanId)
                ->where('idUser', $userId)
                ->first();
            
            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil diperbarui'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . json_encode($e->errors())
            ], 422);
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
