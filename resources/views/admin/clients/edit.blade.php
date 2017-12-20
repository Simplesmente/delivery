@extends('app')

@section('content')

<div class="container">

<h3>Editando Usuário: <b>{{ $client->user->name }}</b> </h3>


	{!! Form::model($client,['route' => ['admin.client.update',$client->id] ] ) !!}

		@include('admin.clients._form')

	<div class="form-group">
		{!! Form::submit('Salvar',['class' => 'btn btn-block btn-primary']) !!}
	</div>


	{!! Form::close() !!}

</div>


@endsection