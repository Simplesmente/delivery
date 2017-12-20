@extends('app')

@section('content')

<div class="container">

	<div class="panel panel-default">
	  <div class="panel-heading"><h3>Produtos</h3></div>
	  <div class="panel-body">
	  <a href="{{ route('admin.products.create')}}" class="btn btn-info">Novo Produto</a>
	    <table class="table">
	    	<thead>
	    		<tr>
	    			<th>ID</th>
	    			<th>Nome</th>
	    			<th>Categoria</th>
	    			<th>Descrição</th>
	    			<th>Preço</th>
	    			<th>Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>

	    		@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->category->name }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->price }}</td>
					<td>
						<a href="{{ route('admin.product.destroy',['id' => $product->id]) }}" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
						</a>

						<a href="{{ route('admin.product.edit',['id' => $product->id] )}}" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
	
	    	</tbody>
	    </table>
	  </div>
	</div>

	    {!! $products->render() !!}

</div>
@endsection