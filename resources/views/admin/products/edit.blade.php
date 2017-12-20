@extends('app')

@section('content')

<div class="container">

<h3>Editando Produto: <b>{{ $product->name }}</b> </h3>


	{!! Form::model($product,['route' => ['admin.product.update', 'id' => $product->id] ] ) !!}

		@include('admin.products._form')

	<div class="form-group">
		{!! Form::submit('Salvar',['class' => 'btn btn-block btn-primary']) !!}
	</div>


	{!! Form::close() !!}

</div>


@endsection