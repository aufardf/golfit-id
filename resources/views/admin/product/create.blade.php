@extends('template_backend.home')
@section('sub-judul', 'Tambah Product')
@section('content')

    @if (count($errors)>0)
        @foreach ($errors->all() as $error ) 
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
        @endforeach
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>    
    @endif

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Masukkan Nama Product</label>
        <input type="text" class="form-control " name="name">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="category_id">
            <option value="" holder>Pilih Kategori</option>
            @foreach ($category as $result)
            <option value="{{ $result->id }}">{{ $result->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Gambar</label>
        <input type="file" class="form-control " name="gambar">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach ( $tags as $tag )
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    <div class="form-group">
        <label>Quantity</label>
        <input type="text" class="form-control " name="qty">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control " name="price">
    </div>
    <div class="form-group">
        <label>Diskon (optional)</label>
        <input type="text" class="form-control " name="discount">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block">Simpan Product</button>
    </div>
    </form>
@endsection