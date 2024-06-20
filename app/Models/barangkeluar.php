<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Barangkeluar extends Model
// {
//     use HasFactory;
//     protected $table = 'barangkeluar';
//     protected $fillable = ['tgl_keluar', 'qty_keluar', 'barang_id'];

//     public function barang()
//     {
//         return $this->belongsTo('App\Models\Barang', 'barang_id', 'id');
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangkeluar extends Model
{
    use HasFactory;
    protected $table = 'barangkeluar';
    protected $fillable = ['tgl_keluar', 'qty_keluar', 'barang_id'];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id', 'id');
    }

    public function barangmasuk()
    {
        return $this->belongsTo('App\Models\barangmasuk', 'barang_id', 'id');
    }
}