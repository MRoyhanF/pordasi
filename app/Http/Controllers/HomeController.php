<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Stable;
use App\Models\Atlet;
use App\Models\Kuda;
use App\Models\Pelatih;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'stable' => Stable::count(),
            'atlet'  => Atlet::count(),
            'kuda'   => Kuda::count(),
            'pelatih' => Pelatih::count(),
        ];

        $latestBerita = Berita::published()->latest('published_at')->take(3)->get();

        return view('home', compact('stats', 'latestBerita'));
    }

    public function profil()
    {
        return view('public.profil');
    }

    public function visiMisi()
    {
        return view('public.visi-misi');
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
