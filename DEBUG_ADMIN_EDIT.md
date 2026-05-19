# Debug Tips untuk Fitur Admin Edit

## Masalah yang Umum Terjadi

### 1. Error: "Admin tidak ditemukan"
Masalah ini bisa terjadi karena beberapa alasan:

#### Solusi:
Buka **Browser Console** (F12 → Console tab) dan:

1. **Klik Edit Button pada Admin**
2. **Lihat Console Output** untuk melihat:
   - Request URL yang di-send
   - Kabupaten ID yang digunakan
   - Response status dan data yang dikembalikan

#### Contoh Output yang Harus Anda Lihat:
```
Admin init script loaded
window.kabupatenId value: 1
Initializing admin context with kabupaten ID: 1
Admin event listeners initialized
Edit button clicked - ID: 2 Name: John Doe
Fetching from: /kabupaten/1/admin/2
Response Status: 200
Full Response Data: {admin: {...}, success: true}
Successfully fetched admin data: {admin: {...}}
```

#### Jika Ada Error:
```
Response Status: 404
Full Response Data: {error: "Admin tidak ditemukan", details: "..."}
Error fetching admin: Admin tidak ditemukan
```

### 2. Kemungkinan Penyebab

**A. Admin Sudah Dihapus (Soft Delete)**
- Error akan menampilkan: "Admin ini telah dihapus dan tidak bisa diedit"
- Solusi: Refresh halaman untuk update data terbaru

**B. ID User Tidak Sesuai**
- Check di console apakah ID yang di-send sesuai dengan yang ada di database
- Lihat di table admin_kabupaten apakah kombinasi (idUser, idKabupaten) ada

**C. Relationship User Tidak Ter-load**
- Error: "Data user admin tidak lengkap - silahkan refresh halaman"
- Solusi: Refresh halaman dan coba lagi

## Logs di Server

Periksa file log di: `storage/logs/laravel.log`

```
[INFO] Getting admin: {"kabupatanId": 1, "userId": 2}
[INFO] Admin found: {"admin_id": 2, "kabupaten_id": 1}
```

atau jika ada error:

```
[WARNING] Admin not found: {"user_id": 2, "kabupaten_id": 1}
```

## Testing Steps

1. **Buka halaman Kabupaten Detail**
2. **Scroll ke table Admin Kabupaten**
3. **Klik tombol Edit (icon pensil)**
4. **Check Browser Console untuk debug info**
5. **Modal seharusnya terbuka dengan data admin ter-fill**

---

Jika masih ada masalah:
1. Buka Browser DevTools (F12)
2. Pergi ke Network tab
3. Klik Edit button dan lihat request yang di-send
4. Lihat response dari server
5. Share error message dan response data untuk debugging lebih lanjut
