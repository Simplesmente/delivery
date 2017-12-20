@extends('app')

@section('content')

<div class="container">

<h3>Editando Categoria: <b>{{ $category->name }}</b></h3>

@include('admin.categories.errors._check-errors')


{!! Form::model($category,['route' => ['admin.category.update', 'id' => $category->id] ] ) !!}

@include('admin.categories._form')

<div class="form-group">
	{!! Form::submit('Salvar Categoria',['class' => 'btn btn-block btn-primary']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection