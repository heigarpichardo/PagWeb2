@extends('layouts.admin')
@section('contenido')
<h3>Nuevo Servicio</h3>
{!!Form::open(array('url'=>'procesos/Ventas','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
		<div class="form-group{{ $errors->has('cliente') ? ' has-error' : '' }}">
			<label for="cliente">Cliente</label>
			<input type="text" name="cliente" id="cliente" readonly="" class="form-control" value="{{strtoupper($cliente->nombre)}} {{strtoupper($cliente->apellido)}}"></input>
			@if ($errors->has('cliente'))
                <span class="help-block">
                    <strong>{{ $errors->first('cliente') }}</strong>
                </span>
            @endif
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group{{ $errors->has('NCF') ? ' has-error' : '' }}">
			<label for="NCF">NCF</label>
			<input type="text" name="NCF" class="form-control" readonly="" placeholder="NCF..." value="{{$NCF}}"></input>
			@if ($errors->has('NCF'))
                <span class="help-block">
                    <strong>{{ $errors->first('NCF') }}</strong>
                </span>
            @endif
		</div>
	</div>
</div>	
<div class="row">
	<!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
			<label for="fecha">Fecha</label>
			<input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}"></input>
			@if ($errors->has('fecha'))
                <span class="help-block">
                    <strong>{{ $errors->first('fecha') }}</strong>
                </span>
            @endif
		</div>
	</div>-->
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<label for="tipo_venta">Condicion</label>
		<br>
		<div class="form-group{{ $errors->has('tipoventa') ? ' has-error' : '' }}">
			<input type="radio" name="tipoventa" value="1" checked> Contado
			<input type="radio" name="tipoventa" value="2"> Credito
		</div>
	</div>
</div>	

<div class="row">
	<div class="col-lg-11 col-sm-11 col-md-11 col-xs-12">
		<div class="form-group">
			<label>Articulo</label>
			<select name="pidarticulo" class="form-control select2" id="pidarticulo" data-live-search="true" data-style="btn-default">
				@foreach($articulo as $art)
					<option value="{{$art->codigo_servicio}}">{{$art->codigo_servicio.'-'.$art->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<!--<div class="col-lg-11 col-sm-11 col-md-11 col-xs-12">
		<div class="form-group">
			<label>Articulo</label>
			<input type="text" name="pidarticulo" id="pidarticulo" class="form-control" data-live-search="true" data-style="btn-default">
			</input>
		</div>
	</div>-->
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-10">
		<div class="form-group">
			<label for="monto">Monto</label>
			<input type="number" name="pmonto" id="pmonto" class="form-control" placeholder="monto" maxlength="20">
		</div>
	</div>
	<br>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
		<div class="form-group">
			<br>
			<button type="button" id="bt_add" class="btn btn-success" title="Agregar" ><i class="fa fa-plus" aria-hidden="true"></i></button>
		</div>
	</div>

	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<tr class="bg-success">
					<th>ID</th>
					<th>Descripcion</th>
					<th>Cantidad</th>
					<th>Monto</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			<tfoot>
				<th>Total</th>
				<th></th>
				<th></th>
				<th></th>
			</tfoot>
		</table>
	</div>	
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">	
			<button class="btn btn-success" type="submit">Guardar</button>
		</div>
	</div>
</div>		
{!!Form::close()!!}

<!--@push('scripts')-->
<script>

	$(document).ready(function(){
		$('#bt_add').click(function(){
			agregar();
		});
		//document.getElementById('fecha').value = new Date().toDateInputValue();
	});

	var cont= 0;
	total = 0;
	subtotal = [];

	$("#guardar").hide();

	var idart = [];
	var cant = [];
	var obser = [];

	function ValidarSiExisteArticulo(idarticulo)
	{
		for(a=0;a<idart.length;a++)
		{
			if(idart[a] == idarticulo)
			{
				return true;
			}
		}
		return false;
	}

	function agregar()
	{
		idarticulo = $("#pidarticulo").val();
		articulo = $("#pidarticulo option:selected").text();
		cantidad = $("#pcantidad").val();
		//observacion = $("#pobservacion").val();
		
		var pos = idart.indexOf(parseInt(idarticulo));

		if(idart.indexOf(parseInt(idarticulo)) != -1 && Validar(cantidad))
		{
			cant[pos] = parseInt(cant[pos]) + parseInt(cantidad);
			cantidad = cant[pos];

			if(ValidarSiExisteArticulo(parseInt(idarticulo)))
			{
				eliminar(idarticulo);

				idart.push(parseInt(idarticulo));
				cant.push(parseFloat(cantidad));
				//obser.push(parseFloat(observacion));

				AgregarFila(idarticulo,articulo,cantidad);
				evaluar();

				limpiar();
			}
		}
		else if(Validar(cantidad))
		{
			idart.push(parseInt(idarticulo));
			cant.push(parseInt(cantidad));
			//obser.push(parseFloat(observacion));
			
			AgregarFila(idarticulo,articulo,cantidad);
		}
	}

	function AgregarFila(idarticulo,articulo,cantidad)
	{
		
		var fila = '<tr class="selected" id="fila'+idarticulo+'"><td><button type="botton" class="btn btn-danger btn-sm" onclick="eliminar('+idarticulo+');"><i class="fa fa-minus" aria-hidden="true"></i></button></td><td><input type="hidden" name="idart[]" value="'+idarticulo+'">'+articulo+'</td><td ><input type="hidden"  name="cant[]" value="'+cantidad+'" readonly><span class="pcant'+idarticulo+'">'+cantidad+'</span><td><input type="hidden"  name="obser[]" value="'+cantidad+'" readonly><span>'+cantidad+'</span></td></tr>';
			cont++;
			limpiar();
			evaluar();
			$('#detalles').append(fila);
	}

	function Validar(cantidad)
	{
		
		if(cantidad == "")
		{
			toastr.error("Error al ingresar La Requisicion, Favor digite la cantidad");
			return false;
		}
		else if(cantidad <= 0)
		{
			toastr.error("Error al ingresar la Requisicion, Favor digite la cantidad mayor que cero");
			return false;
		}
		else
		{
			return true;
		}

	}
	
	function limpiar()
	{
		$("#pcantidad").val("");
		//$("#pobservacion").val("");
	}
	//evita enviar un ingreso sin detalles
	function evaluar()
	{
		if (idart.length > 0)
		{
			$("#guardar").show();
		}
		else
		{
			$("#guardar").hide();
		}
	}
	function eliminar(index)
	{
		var pos = idart.indexOf(index);

		idart.splice(pos,1);
		cant.splice(pos,1);
		//obser.splice(pos,1);

		cont--;
		$("#fila" + index).remove();
		evaluar();
	}
</script>	
<!--@endpush-->
@endsection