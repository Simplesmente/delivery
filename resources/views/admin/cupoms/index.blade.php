@extends('app')

@section('content')

<div class="container">
	
	<div class="panel panel-default">
	  <div class="panel-heading"><h3>Cupoms</h3></div>
	  <div class="panel-body">
	  <a href="{{ route('admin.cupom.create')}}" class="btn btn-info">Novo Cupom</a>
	    <table class="table">
	    	<thead>
	    		<tr>
	    			<th>ID</th>
	    			<th>Código</th>
	    			<th>Valor</th>
	    				    			
	    		</tr>
	    	</thead>
	    	<tbody>

	    		@foreach($cupoms as $cupom)
				<tr>
					<td>{{ $cupom->id }}</td>
					<td>{{ $cupom->code }}</td>
					<td>{{ $cupom->value }}</td>
					
					<td>
						<a href="#" class="btn btn-sm btn-danger disabled">
							<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
						</a>

						<a href="{{ route('admin.cupom.edit',['id' => $cupom->id])}}" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
	
	    	</tbody>
	    </table>
	  </div>
	</div>

	    {!! $cupoms->render() !!}


</div>
@endsection