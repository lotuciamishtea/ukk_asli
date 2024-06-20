<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Barangmasuk extends Model
// {
//     use HasFactory;
//     protected $table = 'barangmasuk';
//     protected $fillable = ['tgl_masuk', 'qty_masuk', 'barang_id'];

//     public function barang()
//     {
//         return $this->belongsTo('App\Models\Barang', 'barang_id', 'id');
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangmasuk extends Model
{
    use HasFactory;
    protected $table = 'barangmasuk';
    protected $fillable = ['tgl_masuk', 'qty_masuk', 'barang_id'];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id', 'id');
    }

    public function barangkeluar()
    {
        return $this->hasMany('App\Models\barangkeluar', 'barang_id', 'id');
    }
}

