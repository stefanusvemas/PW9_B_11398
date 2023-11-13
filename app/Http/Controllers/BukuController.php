<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->paginate(5);
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
        ]);

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'id_penerbit' => auth()->user()->id_user,
            'status' => 'Tersedia',
        ]);

        try {
            Buku::create($request->all());
            return redirect()->route('buku.index');
        } catch (Exception $e) {
            return redirect()->route('buku.index');
        }
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $this->validate($request, [
            'judul' => 'required',
            'penulis' => 'required',
        ]);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
        ]);

        return redirect()->route('buku.index')->with(['success' => 'Buku berhasil diubah!']);
    }

    function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect()->route('buku.index');
    }
}
