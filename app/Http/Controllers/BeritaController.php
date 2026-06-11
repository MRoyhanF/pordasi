<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with('author')->latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $beritas = $query->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'ringkasan'  => 'nullable|string|max:500',
            'isi_berita' => 'required|string',
            'status'     => 'required|in:draft,published',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'isi_berita', 'status']);
        $data['slug'] = Berita::generateSlug($request->judul);
        $data['created_by'] = Auth::id();

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $beritum)
    {
        return view('admin.berita.show', ['berita' => $beritum]);
    }

    public function edit(Berita $beritum)
    {
        return view('admin.berita.edit', ['berita' => $beritum]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'ringkasan'  => 'nullable|string|max:500',
            'isi_berita' => 'required|string',
            'status'     => 'required|in:draft,published',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'isi_berita', 'status']);

        if ($request->status === 'published' && $beritum->status !== 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($beritum->thumbnail) {
                Storage::disk('public')->delete($beritum->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->thumbnail) {
            Storage::disk('public')->delete($beritum->thumbnail);
        }

        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
