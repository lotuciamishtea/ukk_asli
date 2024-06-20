@extends('layouts')

@section('konten')
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Barang</h5>
                <p class="card-text">Lihat data barang</p>
                <a href="{{ route('barang.index') }}" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kategori</h5>
                <p class="card-text">Lihat data kategori</p>
                <a href="{{ route('kategori.index') }}" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Barang Masuk</h5>
                <p class="card-text">Lihat data barang masuk</p>
                <a href="{{ route('barangmasuk.index') }}" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Barang Keluar</h5>
                <p class="card-text">Lihat data barang keluar</p>
                <a href="{{ route('barangkeluar.index') }}" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
</div>
@endsection