<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\KategoriResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KategoriResource::collection(Kategori::all()); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);
    
        // Cek apakah deskripsi sudah ada
        $existingCategory = Kategori::where('deskripsi', $request->deskripsi)->first();
        if ($existingCategory) {
            return response()->json(['error' => 'Kategori Sudah Ada']);
        }
    
        // Buat kategori baru
        $kategoriNew = Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return response()->json([$kategoriNew]);    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new KategoriResource(Kategori::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);        
    
        // Cek apakah deskripsi sudah ada selain kategori yang sedang di-update
        $existingCategory = Kategori::where('deskripsi', $request->deskripsi)
                                    ->where('id', '!=', $id)
                                    ->first();
    
        if ($existingCategory) {
            return response()->json(['error' => 'Kategori Sudah Ada']);
        }
    
        $rsetKategori = Kategori::find($id);
    
        // Update post
        $rsetKategori->update([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);
    
        // Redirect ke index dengan notifikasi
        return response()->json([$rsetKategori]);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return response()->json(['error' => 'Gagal Hapus Barang']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return response()->json(['succes' => 'Berhasil Hapus Barang']);
        }

    }
}
