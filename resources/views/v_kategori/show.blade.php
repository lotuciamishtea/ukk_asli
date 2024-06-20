@extends('layouts')

@section('konten')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Kategori</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $rsetKategori->id }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $rsetKategori->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $deskripsiKategori }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
