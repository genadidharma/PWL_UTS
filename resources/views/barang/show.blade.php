@extends('barang.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Detail barang
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Kode Barang: </b>{{$barang->kode_barang}}</li>
                    <li class="list-group-item"><b>Nama Barang: </b>{{$barang->nama_barang}}</li>
                    <li class="list-group-item"><b>Kategori: </b>{{$barang->kategori_barang}}</li>
                    <li class="list-group-item"><b>Harga: </b>{{$barang->harga}}</li>
                    <li class="list-group-item"><b>Jumlah: </b>{{$barang->qty}}</li>
                </ul>
            </div>
            <a class="btn btn-success mx-3" href="{{ route('barang.index') }}">Kembali</a>
            <div class="d-flex justify-content-between">
                <a class="btn m-3 {{isset($prev->id_barang) ? 'btn-outline-primary' : 'disabled' }}" href="{{ isset($prev->id_barang) ? route('barang.show', $prev->id_barang) : '' }}"><i class="fas fa-chevron-left"></i> Sebelumnya</i></a>
                <a class="btn m-3 {{isset($next->id_barang) ? 'btn-outline-primary' : 'disabled' }}" href="{{ isset($next->id_barang) ? route('barang.show', $next->id_barang) : '' }}">Selanjutnya <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection