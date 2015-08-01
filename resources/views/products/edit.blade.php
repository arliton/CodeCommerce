@extends('app')

@section('content')
    <div class="container">
        <h1>Editing Product: {{ $product->name }}</h1>

        @if ($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route' => ['admin.products.update', $product->id], 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('category', 'Category:') !!}
                {!! Form::select('category_id', $categories, $product->category->id, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Preço:') !!}
                <input type="text" required="required" value="{{number_format($product->price,2)}}" name="price">
            </div>

            <div class="form-group">
                {!! Form::label('featured', 'Featured:') !!}
                {!! Form::hidden('featured', 0) !!}
                {!! Form::checkbox('featured', null, $product->featured) !!}
            </div>

            <div class="form-group">
                {!! Form::label('recommended', 'Recommended:') !!}
                {!! Form::hidden('recommended', 0) !!}
                {!! Form::checkbox('recommended', null, $product->recommended) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Product', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

        <br>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Voltar</a>
        <br><br>

    </div>
@endsection