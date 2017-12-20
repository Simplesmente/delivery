
@extends('app')

@section('content')

<div class="container">

<h3>Novo Cupom</h3>

@include('admin.cupoms.errors._check-errors')


{!! Form::open(['route' => 'admin.cupom.store']) !!}


@include('admin.cupoms._form')

<div class="form-group">
	{!! Form::submit('Criar Cupom',['class' => 'btn btn-block btn-primary']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection