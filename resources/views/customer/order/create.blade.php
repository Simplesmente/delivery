@extends('app')

@section('content')

<div class="container">

<h3>Novo Pedido</h3>

@include('customer.order.errors._check-errors')

<div class="container">
{!! Form::open(['route' => 'customer.order.store','class'=>'form']) !!}
<div class="form-group">
<label for="total">Total:</label>
<p id="total"></p>

<a href="#" id="btnNewItem" class="btn btn-primary">Novo Item</a>
<br><br>
<table class="table table-bordered">
<thead>
<tr>
<th>Produto</th>
<th>Quantidade</th>
</tr>
</thead>

<tbody>
<tr>
<td>
<select name="items[0][product_id]" id="" class="form-control">
@foreach($products as $p)
<option value="{{ $p->id }}" data-price="{{ $p->price}}">{{$p->name}} --- {{$p->price}}</option>
@endforeach
</select>
</td>

<td>
{!! Form::text('items[0][qtd]',1,['class' => 'form-control']) !!}
</td>
</tr>
</tbody>
</table>
</div>

<div class="form-group">
{!! Form::submit('Criar Pedido',['class' => 'btn btn-success']) !!}
</div>
{!! Form::close() !!}
</div>
</div>

@endsection

@section('post-script')

<script>

$(function(){
	$('#btnNewItem').click(function(){
		addItem();
		calTotal();
	});
	$(document.body).on('click','select',function(){
		calTotal();
	});
	$(document.body).on('blur','input',function(){
		calTotal();
	});
	
	
	var calTotal = function calTotal(){
		var total = 0;
		var trLenth = $('table tbody tr').length;
		var tr = null;
		var price = 0;
		var qtd   = 0;
		for (var i =0; i < trLenth; i++) {
			tr = $('table tbody tr').eq(i);
			price = tr.find(':selected').data('price');
			qtd = tr.find('input').val();
			total += price * qtd;
		}	
		$('#total').html(total);
	}
	
	var addItem = function addItem(){
		var currentRow = $('table tbody > tr:last');
		var newRow = currentRow.clone();
		var lengthRow = $('table tbody tr').length;
		newRow.find('td').each(function(){
			var td = $(this);
			var input = td.find('input,select');
			var name = input.attr('name');
			input.attr('name',name.replace((length -1 ) + "", length + "") );
		});
		newRow.find('input').val(1);
		newRow.insertAfter(currentRow);
	}
	
});	

</script>

@endsection