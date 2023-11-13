<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinjamBuku;
use App\Models\Buku;

class KembaliController extends Controller
{
    public function index()
    {
        $pinjam = PinjamBuku::where('id_peminjam', auth()->id())
            ->join('bukus', 'pinjam_bukus.id_buku', '=', 'bukus.id')
            ->paginate(5);

        return view('kembali.index', compact('pinjam'));
    }

    public function edit(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->status = 'Tersedia';
        $buku->save();

        $kembali = PinjamBuku::where('id_buku', '=', $id)->whereNull('tanggal_kembali')->firstOrFail();
        $kembali->tanggal_kembali = now();
        $kembali->save();
        return redirect()->route('kembali.index');
    }
}
