@extends('app')

@section('content')

<div class="container">

	<div class="panel panel-default">
	  <div class="panel-heading"><h3>Pedidos</h3></div>
	  <div class="panel-body">
	 
	    <table class="table">
	    	<thead>
	    		<tr>
	    			<th>ID</th>
	    			<th>Itens</th>
	    			<th>Data</th>
	    			<th>Total</th>
	    			<th>Entregador</th>
	    			<th>Status</th>
	    			<th>Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>

	    		@foreach($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>
						@foreach($order->items as $item)
							<li>{{$item->product->name}}</li>
						@endforeach
					</td>
					<td>{{ $order->created_at }}</td>
					<td>{{ $order->total }}</td>
					<td>
						@if($order->deliveryman)
							{{ $order->deliveryman->name }}
						@else
							<span class="label label-danger ">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								Não atribuído
							</span>
						@endif
					</td>
					<td>
						@if ($order->status == 0)
						    <span class="label label-default">Pendente</span>
						@elseif ( $order->status == 1)
						    <span class="label label-info">Despachado</span>
						@else
							<span class="label label-success">Entregue</span>
						@endif
					</td>
				
					<td>
						<a href="#" class="btn btn-sm btn-danger disabled">
							<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
						</a>

						<a href="{{ route('admin.pedidos.edit',['id' => $order->id]) }}" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
	
	    	</tbody>
	    </table>
	  </div>
	</div>

	    {!! $orders->render()!!}

</div>




@endsection