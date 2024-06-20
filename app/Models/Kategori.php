<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


// Barang model
// Author : mrantazy68
// Written: 2023 - PKK
// URL    : experimen.test
// ---------------------------------------------------------------------------

class Kategori extends Model
{
    use HasFactory;

    //setup nama tabel yang digunakan dalam model
    protected $table = 'kategori';

    //setup daftar field pada table kategori yang bisa CRUD interaksi user
    protected $fillable = ['deskripsi','kategori'];

    //method barang
    //merelasikan tabel kategori ke tabel barang (one to many)
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    //method getKategoriAll()
    //query untuk mengakses seluruh record tabel kategori
    //query untuk memanggil store function ketKategori(), diberi nama field baru ketkategori
    public static function getKategoriAll(){
        return DB::table('kategori')
                    ->select('kategori.id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'));
    }

    //method katShowAll()
    //query untuk mengakses seluruh record tabel kategori
    //merelasikan dengan tabel barang
    // query untuk memanggil store function ketKategori(), diberi nama field baru ketkategori
    public static function katShowAll(){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                ->select('kategori.id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'),
                         'barang.merk');
                // ->pagination(1);
                // ->get();

    }

    //method showKategoriById()
    //query untuk mengakses seluruh record tabel kategori
    //merelasikan dengan tabel barang
    //query untuk memanggil store function ketKategori(), diberi nama field baru ketkategori
    //menggunakan kriteria kategori.id tertentu
    public static function showKategoriById($id){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                ->select('barang.id','kategori.deskripsi',DB::raw('ketKategori(kategori.kategori) as ketkategori'),
                         'barang.merk','barang.seri','barang.spesifikasi','barang.stok')
                ->get();

    }

}