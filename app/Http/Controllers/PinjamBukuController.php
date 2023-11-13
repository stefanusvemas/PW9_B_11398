<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PinjamBuku;
use App\Models\Buku;

class PinjamBukuController extends Controller
{
    public function index()
    {
        $buku = Buku::where('id_penerbit', '!=', auth()->id())->where('status', 'Tersedia')->paginate(5);

        return view('pinjamBuku.index', compact('buku'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
        ]);

        PinjamBuku::create([
            'id_buku' => $request->id_buku,
            'id_peminjam' => auth()->id(),
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => null,
        ]);

        Buku::where('id', $request->id_buku)->update(['status' => 'Dipinjam']);

        return redirect()->route('pinjam_buku.index');
    }
}
