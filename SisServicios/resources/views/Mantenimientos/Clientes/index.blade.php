@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="Clientes/create"> <button class="btn btn-success">Crear</button></h3></a>
		@include('Mantenimientos.Clientes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Balance</th>
					<th>Limite de Credito</th>
				</thead>
				<?php foreach ($index as $cat) { ?>
				<tr>
					<td>{{$cat->codigo_cliente}}</td>
					<td>{{$cat->nombre}}</td>
					<td>{{$cat->apellido}}</td>
					<td>{{$cat->balance}}</td>
					<td>{{$cat->limite_credito}}</td>
					<td>
						<a href="{{URL::action('ClientesController@edit',$cat->codigo_cliente)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->codigo_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Mantenimientos.Clientes.modal')
				<?php } ?>
			</table>
		</div>
		{{$index->render()}}
	</div>
</div>
@endsection