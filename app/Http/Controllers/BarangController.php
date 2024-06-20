<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');

    // Cari kategori berdasarkan nama
    $kategori = Kategori::where('deskripsi', 'LIKE', "%$query%")->get();

    // Cari barang berdasarkan nama
    $barang = Barang::where('seri', 'LIKE', "%$query%")->get();

    // Jika hasil pencarian mengembalikan satu kategori, redirect ke tampilan show kategori
    if ($kategori->count() === 1) {
        return redirect()->route('kategori.show', $kategori->first()->id);
    }

    // Jika hasil pencarian mengembalikan satu barang, redirect ke tampilan show barang
    if ($barang->count() === 1) {
        return redirect()->route('barang.show', $barang->first()->id);
    }

    // Jika tidak ada hasil yang ditemukan, kembalikan ke halaman sebelumnya dengan pesan
    return back()->with('error', 'Kategori atau Barang tidak ditemukan');
}

	public function index(Request $request)
    {
        $rsetBarang = Barang::with('kategori')->latest()->paginate(10);

        return view('v_barang.index', compact('rsetBarang'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akategori = Kategori::all();
        return view('v_barang.create',compact('akategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        //validate form
        $request->validate([
            'merk'          => 'required',
            'seri'          => 'required',
            'spesifikasi'   => 'required',
            'kategori_id'   => 'required|not_in:blank',
            'foto'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        //create post
        Barang::create([
            'merk'             => $request->merk,
            'seri'             => $request->seri,
            'spesifikasi'      => $request->spesifikasi,
            'kategori_id'      => $request->kategori_id,
            'foto'             => $foto->hashName()
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = Barang::find($id);

        //return $rsetBarang;

        //return view
        return view('v_barang.show', compact('rsetBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $akategori = Kategori::all();
    $rsetBarang = Barang::find($id);
    $selectedKategori = Kategori::find($rsetBarang->kategori_id);

    return view('v_barang.edit', compact('rsetBarang', 'akategori', 'selectedKategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'merk'          => 'required',
            'seri'          => 'required',
            'spesifikasi'   => 'required',
            'kategori_id'   => 'required|not_in:blank',
            'foto'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

    $rsetBarang = Barang::find($id);

    // Set stok ke 0 jika tidak diisi
    $stok = $request->has('stok') ? $request->stok : 0;

    // Check if image is uploaded
    if ($request->hasFile('foto')) {

        // Upload new image
        $foto = $request->file('foto');
        $foto->storeAs('storage/app/public/foto', $foto->hashName());

        // Delete old image
        Storage::delete('storage/app/public/foto/'.$rsetBarang->foto);

        // Update post with new image
        $rsetBarang->update([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'stok'          => $stok,
            'kategori_id'   => $request->kategori_id,
            'foto'          => $foto->hashName()
        ]);

    } else {

        // Update post without image
        $rsetBarang->update([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'stok'          => $stok,
            'kategori_id'   => $request->kategori_id,
        ]);
    }

    // Redirect to the index page with a success message
    return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { {
            if (DB::table('barangmasuk')->where('barang_id', $id)->exists()) {
                return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
            }

            if (DB::table('barangkeluar')->where('barang_id', $id)->exists()) {
                return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
            }

            $rsetBarang = Barang::find($id);
            $rsetBarang->delete();

            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }

    }



}