@extends('app')

@section('content')

<div class="container">

<h3>Nova Categoria</h3>


@include('admin.categories.errors._check-errors')


{!! Form::open(['route' => 'admin.category.store']) !!}

@include('admin.categories._form')

<div class="form-group">
	{!! Form::submit('Criar Categoria',['class' => 'btn btn-block btn-primary']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection