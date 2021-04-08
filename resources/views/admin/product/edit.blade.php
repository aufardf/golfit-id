@extends('template_backend.home')
@section('sub-judul', 'Edit Product')
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

    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label>Masukkan Nama Product</label>
        <input type="text" class="form-control " name="name" value="{{ $product->name }}">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="category_id">
            <option value="" holder>Pilih Kategori</option>
            @foreach ($category as $result)
            <option value="{{ $result->id }}"
                @if($product->category_id == $result->id)
                    selected
                @endif
                >{{ $result->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Gambar</label>
        <input type="file" class="form-control " name="gambar">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="description">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach ( $tags as $tag )
                <option value="{{ $tag->id }}"
                    @foreach ($product->tags as $value)
                        @if($tag->id == $value->id)
                            selected
                        @endif
                    @endforeach
                    >{{ $tag->name }}</option>
            @endforeach
        </select>
    <div class="form-group">
        <label>Quantity</label>
        <input type="text" class="form-control " name="qty" value="{{ $product->qty }}">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control " name="price" value="{{ $product->price }}">
    </div>
    <div class="form-group">
        <label>Diskon (optional)</label>
        <input type="text" class="form-control " name="discount" value="{{ $product->discount }}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block">Update Product</button>
    </div>
    </form>
@endsection