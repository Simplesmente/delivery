@extends('app')

@section('content')

<div class="container">

	<div class="panel panel-default">
	  <div class="panel-heading"><h3>Categorias</h3></div>
	  <div class="panel-body">
	  <a href="{{ route('admin.category.create') }}" class="btn btn-info">Nova Categoria</a>
	    <table class="table">
	    	<thead>
	    		<tr>
	    			<th>ID</th>
	    			<th>Nome</th>
	    			<th>Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>

	    		@foreach($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>
						<a href="{{ route('admin.category.delete',['id' => $category->id]) }}" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
						</a>

						<a href="{{ route('admin.category.edit', ['id'=>$category->id ] ) }}" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
	
	    	</tbody>
	    </table>
	  </div>
	</div>

	    {!! $categories->render()!!}

</div>




@endsection