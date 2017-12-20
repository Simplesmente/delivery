@extends('app')

@section('content')

<div class="container">

<h3>Novo Cliente</h3>


@include('admin.categories.errors._check-errors')


{!! Form::open(['route' => 'admin.client.store']) !!}

@include('admin.clients._form')

<div class="form-group">
	{!! Form::submit('Criar',['class' => 'btn btn-block btn-primary']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection