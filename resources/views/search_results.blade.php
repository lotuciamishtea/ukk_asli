<!-- search_results.blade.php -->

@extends('layouts')

@section('content')
    <div class="container mt-4">
        <h2>Search Results</h2>

        <h3>Categories</h3>
        @if($kategori->isNotEmpty())
            <ul>
                @foreach($kategori as $kat)
                    <li>{{ $kat->nama_kategori }}</li>
                @endforeach
            </ul>
        @else
            <p>No categories found.</p>
        @endif

        <h3>Products</h3>
        @if($barang->isNotEmpty())
            <div class="row">
                @foreach($barang as $brg)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/foto/'.$brg->foto) }}" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $brg->merk }}</h5>
                                <p class="card-text">{{ $brg->deskripsi }}</p>
                                <a href="{{ route('barang.show', $brg->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products found.</p>
        @endif
    </div>
@endsection
