@extends ('layouts.admin')
@section ('contenido')
	<div class="form-inline">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Añadir Secuencia de Comprobantes</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				<?php foreach ($errors->all() as $error){ ?>
					<li>{{$error}}</li>
				<?php } ?>
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'Mantenimientos/Comprobantes','method'=>'POST','autocomplete'=>'off'))!!}
			{!!Form::token()!!}
<table class="table table-striped table-bordered table-condensed table-hover">
	<tr>
			<td>			
				<label for="nombre">Serial</label>
			</td>
			<td>
				<input type="text" name="serial" class="form-control" placeholder="Serial..." style="width: 100px">
			</td>
			<td>
				<label for="nombre">Tipo</label>
			</td>
			<td>
				<input type="text" name="tipo" class="form-control" placeholder="Tipo..." style="width: 100px">
			</td>
			<td>
				<label for="nombre">Secuencia</label>
			</td>
			<td>
				<input type="text" name="secuencia" class="form-control" placeholder="#Inicial..." style="width: 100px">
			</td>
			<td>
				<label for="nombre">Final</label>
			</td>
			<td>
				<input type="text" name="final" class="form-control" placeholder="#Final..." style="width: 100px">
			</td>
			<td>
				<button class="btn btn-success" type="button" onclick="agregar();">Añadir</button>
			</td>
			<td>
				<button class="btn btn-danger" type="reset">Eliminar</button>
			</td>
	</tr>
</table>
			

	<div style="margin-top: 20px">
		<table id="detalles" class="table table-striped table-bordered table-condensed table-hover"">
			<thead>
				<tr class="bg-success">
					<th width="158px">Serial</th>
					<th width="150px">Tipo</th>
					<th width="158px">Secuencia Incial</th>
					<th width="158px">Secuencia Final</th>
				</tr>
			</thead>
		
		</table>
	</div>	

			<div class="form-group" style="margin-top: 25px">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>

<?php
function agregar()
	{
		$serial = $_POST['serial'];
		$tipo = $_POST['tipo'];
		$secuencia = $_POST["secuencia"];
		$sfinal = $_POST["final"];
		
		//var pos = idart.indexOf(parseInt(idarticulo));
		AgregarFila($serial,$tipo,$secuencia,$sfinal);
		//evaluar();
		limpiar();
		
	}

	function AgregarFila($idarticulo,$articulo,$cantidad,$observacion)
	{
		
		 $fila = '<tr class="selected" id="fila'+$idarticulo+'"><td><button type="botton" class="btn btn-danger btn-sm" onclick="eliminar('+$idarticulo+');"><i class="fa fa-minus" aria-hidden="true"></i></button></td><td><input type="hidden" name="idart[]" value="'+$idarticulo+'">'+$articulo+'</td><td ><input type="hidden"  name="cant[]" value="'+$cantidad+'" readonly><span class="pcant'+$idarticulo+'">'+$cantidad+'</span><td><input type="hidden"  name="obser[]" value="'+$observacion+'" readonly><span>'+$observacion+'</span></td></tr>';
			//$cont++;
			limpiar();
			//evaluar();
	}

/*function limpiar()
	{
		$("#serial").val("");
		$("#tipo").val("");
		$("#secuencia").val("");
		$("#final").val("");
	}

function eliminar(index)
	{
		var pos = idart.indexOf(index);

		idart.splice(pos,1);
		cant.splice(pos,1);
		obser.splice(pos,1);

		cont--;
		$("#fila" + index).remove();
		//evaluar();
	}
*/
?>

@endsection
