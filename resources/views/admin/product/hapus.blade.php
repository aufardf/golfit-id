@extends('template_backend.home')
@section('sub-judul', 'Product yang dihapus')
@section('content')

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>    
        @endif

        <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Product</th>
                    <th>Kategori</th>
                    <th>Tags</th>
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
                                <li>{{ $tag->name }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td><img src="{{ asset($hasil->gambar) }}" class="img-fluid" style="width:75px" alt=""></td>
                    <td>
                        <form action="{{ route('product.kill', $hasil->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <a href="{{ route('product.restore', $hasil->id) }}" class="btn btn-info btn-sm">Restore</a> 
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $product->links() }}
        
@endsection
