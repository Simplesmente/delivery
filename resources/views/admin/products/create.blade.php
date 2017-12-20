@extends('app')

@section('content')

<div class="container">

<h3>Novo Produto</h3>


	{!! Form::open(['route' => 'admin.product.store']) !!}

	@include('admin.products._form')

	<div class="form-group">
		{!! Form::submit('Criar Produto',['class' => 'btn btn-block btn-primary']) !!}
	</div>

	{!! Form::close() !!}

</div>


@endsection