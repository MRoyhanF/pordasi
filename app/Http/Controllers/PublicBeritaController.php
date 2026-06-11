<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class PublicBeritaController extends Controller
{
    public function index(Request $request)
    {
        $beritas = Berita::published()
            ->latest('published_at')
            ->paginate(9);

        return view('public.berita.index', compact('beritas'));
    }

    public function show(string $slug)
    {
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();

        $related = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.berita.show', compact('berita', 'related'));
    }
}
