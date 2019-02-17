@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Cobros</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>		
	</div>
	{!! Form::open(array('url'=>'procesos/cobros/create','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
	<div class="form-group">
		<div class="input-group">
			<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Buscar</button>
			</span>		
		</div>
	</div>
	{{Form::close()}}
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			{!!Form::open(array('url'=>'procesos/cobros','method'=>'POST','autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="id_estudiante">Estudiante</label>
				<input type="text" id="id_estudiante" value="{{$cuotas[0]->id_estudiante}}" name="id_estudiante" class="form-control" placeholder="ID Estudiante...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="Nombre">Nombre</label>
				<input type="text" id="nombre" value="{{$cuotas[0]->nom_persona}}" name="nombre" readonly="" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="date" name="fecha" class="form-control" placeholder="Fecha...">
			</div>
		</div>
	</div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color:#A9D0f5">
									<th>Id_cuotas</th>
									<th>Fecha</th>
									<th>Balance</th>
									<th>Monto</th>
									<th>Comentario</th>
								</thead>
								@foreach($cuotas as $cat)
								<tr>
									<td>{{ $cat->id_cuotas}}</td>
									<td>{{ $cat->fecha}}</td>
									<td>{{ $cat->balance}}</td>
									<td name="tdmonto"><input type="number" id="pmonto{{ $cat->id_cuotas}}" name="monto" class="form-control" value="0.00" min="0" step="any" onBeforeInput="acttotal({{$cat->id_cuotas}})" onchange="prueba({{$cat->id_cuotas}})" ></td>
									<td><input type="text" name="comentario" class="form-control" placeholder="Comentario.."></td>
								</tr>
								@endforeach
								<tfoot>
									<th>Total</th>
									<th></th>
									<th></th>
									<th></th>
									<th><h4 id="total">S/. 0.00</h4></th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>	
	{!!Form::close()!!}

@push ('scripts')

<script>

	/*$(document).ready(function(){
		$('#pmonto').onkeyup(function(){
			actualizar();
		});
	});*/

	var cont = 0;
	total = 0;
	subtotal =[];
	$("#guardar").hide();

	function actualizar()
	{
		monto=$("#pmonto").val();

		if(monto>0)
		{
			total = total + monto;
			$("#total").html("S/. "+total)
		}
	}

	function prueba(valor) {
		var x = document.getElementById("pmonto" +valor).value;

		subtotal[valor] = Number(x);
	    total = 0;

	    for(var i in subtotal){
	    total = total + subtotal[i];
	    //alert(subtotal[i]);
	    }
	    $("#total").html("RD$ "+total);
	    evaluar();
	}

	function Estudiante() 
	{
		var x = document.getElementById("id_estudiante").value;
		
		document.getElementById("nombre").value = "hola";
		//alert(x);
	}


	function acttotal(valor)
	{
		var x = document.getElementById("pmonto" +valor).value;
		total = total - Number(x);
	}

	function limpiar(){
		$("#").val("");
	}
	
	function evaluar(){
		if (total>0)
		{
			$("#guardar").show();
		}
		else
		{
			$("#guardar").hide();
		}
	}
</script>

@endpush
@endsection
