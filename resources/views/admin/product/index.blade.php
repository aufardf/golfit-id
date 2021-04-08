@extends('template_backend.home')
@section('sub-judul', 'Product')
@section('content')

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>    
        @endif

        <a href="{{ route('product.create') }}" class="btn btn-info btn-sm">Tambah Product</a>
        <br><br>

        <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Product</th>
                    <th>Kategori</th>
                    <th>Tags</th>
                    <th>Creator</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($product as $result => $hasil)
                <tr>
                    <td>{{ $result + $product->firstitem() }}</td>
                    <td>{{ $hasil->name }}</td>
                    <td>{{ $hasil->category->name }}</td>
                    <td>
                        @foreach ($hasil->tags as $tag )
                            <ul>
                                <h6><span class="badge badge-info">{{ $tag->name }}</span></h6>
                            </ul>
                        @endforeach
                    </td>
                    <td>{{ $hasil->users->name }}</td>
                    <td><img src="{{ asset($hasil->gambar) }}" class="img-fluid" style="width:75px" alt=""></td>
                    <td>
                        <form action="{{ route('product.destroy', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <a href="{{ route('product.edit', $hasil->id) }}" class="btn btn-primary btn-sm">Edit</a> 
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $product->links() }}
        
@endsection
