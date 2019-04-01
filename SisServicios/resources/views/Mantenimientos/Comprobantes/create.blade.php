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
				<button class="btn btn-success" type="button" name="anadir" id="anadir" onclick="addRows();">Añadir</button>
			</td>
			<!--<td>
				<button class="btn btn-danger" type="reset">Eliminar</button>
			</td> -->
	</tr>
</table>
			

	<div style="margin-top: 20px">
		<table name="detalles" id="detalles" class="table table-striped table-bordered table-condensed table-hover">
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
			
		</div>
	</div>
{!!Form::close()!!}

<script>

	var arreglo_serial = [];
	var arreglo_secuencia = [];
	var arreglo_final = [];
	var arreglo_tipo = [];
	var cantidad = 0



function addRows() {
    var table = document.getElementById( 'detalles' );
      row = table.insertRow(1);
      cell0 = row.insertCell(0);
      cell1 = row.insertCell(1);
      cell2 = row.insertCell(2);
      cell3 = row.insertCell(3);
      cell4= row.insertCell(4);
    

      var serial=document.getElementsByName("serial")[0].value;
      var tipo=document.getElementsByName("tipo")[0].value;
      var secuencia=document.getElementsByName("secuencia")[0].value;
      var final=document.getElementsByName("final")[0].value;

	  arreglo_serial.push(serial);
	  arreglo_tipo.push(parseInt(tipo));
	  arreglo_final.push(parseInt(final));
	  arreglo_secuencia.push(parseInt(secuencia));
	  cantidad = cantidad + 1;

 // cell0.innerHTML = '<input type="hidden"  name="arreglo_serial[]" value="'+serial+'" readonly>';
 // cell1.innerHTML = '<input type="hidden"  name="arreglo_tipo[]" value="'+tipo+'" readonly>';
  //cell2.innerHTML = '<input type="hidden"  name="arreglo_secuencia[]" value="'+secuencia+'" readonly>';
 // cell3.innerHTML = '<input type="hidden"  name="arreglo_final[]" value="'+final+'" readonly>';
 // cell4.innerHTML = '<button class="btn btn-danger" type="reset" onclick="SomeDeleteRowFunction(this)">Eliminar</button>';

  //cell4.appendChild(button);
var fila = '<tr class="selected"><td><input type="hidden" name="arreglo_serial[]" value="'+serial+'">'+serial+'</td><td ><input type="hidden"  name="arreglo_tipo[]" value="'+tipo+'" readonly>'+tipo+'</td><td><input type="hidden"  name="arreglo_secuencia[]" value="'+secuencia+'" readonly><span>'+secuencia+'</span></td><td><input  type="hidden"  name="arreglo_final[]" value="'+final+'" readonly >'+final+'</td><td><button type="botton" class="btn btn-danger btn-sm" onclick="SomeDeleteRowFunction(this)">Eliminar</button></td></tr>';
$('#detalles').append(fila);
}

   function SomeDeleteRowFunction(o) {
     //no clue what to put here?
     var p=o.parentNode.parentNode;
         p.parentNode.removeChild(p);
    }


</script>

@endsection
