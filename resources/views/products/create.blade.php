@extends('app')

@section('content')
    <div class="container">
        <h1>Create Product</h1>

        @if ($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['route' => 'admin.products.store', 'method' => 'post']) !!}
            <div class="form-group">
                {!! Form::label('category', 'Category:') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Preço:') !!}
                <input type="text" required="required" name="price">
            </div>

            <div class="form-group">
                {!! Form::label('featured', 'Featured:') !!}
                {!! Form::checkbox('featured', null, false) !!}
            </div>

            <div class="form-group">
                {!! Form::label('recommended', 'Recommended:') !!}
                {!! Form::checkbox('recommended', null, false) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Add Product', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

        <br>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Voltar</a>
        <br><br>
    </div>
@endsection