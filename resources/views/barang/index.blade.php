@extends('barang.layout')
@section('content')
<div class="row m-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2 mb-3">
            <h2>Gudang Barang A0-11</h2>
        </div>
        <form class="float-right form-inline" id="searchForm" method="get" action="{{ route('barang.index') }}" role="search">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" id="Keyword" aria-describedby="Keyword" placeholder="Keyword" value="{{request()->query('keyword')}}">
            </div>
            <button type="submit" class="btn btn-primary mx-2">Cari</button>
            <a href="{{ route('barang.index') }}">
                <button type="button" class="btn btn-danger">Reset</button>
            </a>
        </form>
        <div class="my-2">
            <a class="btn btn-success" href="{{ route('barang.create') }}"> Input barang </a>
        </div>
    </div>

    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th width="280px">Action</th>
        </tr>
        @foreach($list_barang as $barang)
        <tr>
            <td>{{$barang->kode_barang}}</td>
            <td>{{$barang->nama_barang}}</td>
            <td>{{$barang->kategori_barang}}</td>
            <td>@currency($barang->harga)</td>
            <td>{{$barang->qty}}</td>
            <td>
                <form action="{{route('barang.destroy', $barang->id_barang) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('barang.show', $barang->id_barang) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('barang.edit', $barang->id_barang) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {{ $list_barang->links('pagination::bootstrap-4') }}
    </div>
</div>