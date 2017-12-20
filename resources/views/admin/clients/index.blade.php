@extends('app')

@section('content')

<div class="container">
	
	<div class="panel panel-default">
	  <div class="panel-heading"><h3>Clientes</h3></div>
	  <div class="panel-body">
	  <a href="{{ route('admin.client.create')}}" class="btn btn-info">Novo Cliente</a>
	    <table class="table">
	    	<thead>
	    		<tr>
	    			<th>ID</th>
	    			<th>Nome</th>
	    				    			
	    		</tr>
	    	</thead>
	    	<tbody>

	    		@foreach($clients as $client)
				<tr>
					<td>{{ $client->id }}</td>
					<td>{{ $client->user->name }}</td>
					
					<td>
						<a href="{{ route('admin.client.destroy',['id' => $client->id])}}" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
						</a>

						<a href="{{ route('admin.client.edit',['id' => $client->id])}}" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
	
	    	</tbody>
	    </table>
	  </div>
	</div>

	    {!! $clients->render() !!}


</div>
@endsection