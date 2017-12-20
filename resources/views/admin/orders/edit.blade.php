@extends('app')

@section('content')

<div class="container">
	
	<h1>Pedido # {{$order->id}} - R$ {{ $order->total }}</h1>
	<h2>Cliente: {{$order->client->user->name}} </h2>
	<h3>Data: {{ $order->created_at }}</h3>

	<p>
		<b>Endereço de Entrega: </b><br>
		<address>{{$order->client->address}} - {{ $order->client->city}} - {{$order->client->state}}</address>
	</p>

	{!! Form::model($order,['route' => ['admin.pedido.update',$order->id] ] ) !!}

	<div class="form-group">
		{!! Form::label('Status','Status:')!!}
		{!! Form::select('status', $status, null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('Entregador','Entregador:')!!}
		{!! Form::select('user_deliveryman_id', $deliveryman, null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Editar',['class' => 'btn btn-block btn-primary']) !!}
	</div>


	{!! Form::close() !!}

</div>

@endsection