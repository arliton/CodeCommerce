@extends('app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        <br>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">New Product</a>
        <br><br>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Featured</th>
                <th>Recommended</th>
                <th>Category</th>
                <th>Action</th>
            </tr>

            @foreach($produtos as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ str_limit($product->description, $limit = 50, $end = '...') }}</td>
                    <td>{{ $product->price }}</td>

                    <td>{!! Form::checkbox('featured', null, $product->featured, array('disabled')) !!}</td>
                    <td>{!! Form::checkbox('recommended', null, $product->recommended, array('disabled')) !!}</td>

                    <td>{{ $product->category->name }}</td>

                    <td>
                        <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('admin.products.images', ['id' => $product->id]) }}" class="btn btn-primary">Images</a>
                        <a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $produtos->render() !!}
    </div>
@endsection
