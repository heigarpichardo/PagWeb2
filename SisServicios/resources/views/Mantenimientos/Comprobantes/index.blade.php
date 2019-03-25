@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Secuencias <a href="Comprobantes/create"> <button class="btn btn-success">Crear</button></h3></a>
		@include('Mantenimientos.Comprobantes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Serial</th>
					<th>Tipo</th>
					<th>Secuencia Inicial</th>
					<th>Secuencia Final</th>
				</thead>
				<?php foreach ($index as $cat) { ?>
				<tr>
					<td>{{ $cat->codigo}}</td>
					<td>{{ $cat->serial}}</td>
					<td>{{ $cat->tipo}}</td>
					<td>{{ $cat->secuencia}}</td>
					<td>{{ $cat->final}}</td>
					<td>
						<a href="{{URL::action('ComprobantesController@edit',$cat->codigo)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->codigo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Mantenimientos.Comprobantes.modal')
				<?php } ?>
			</table>
		</div>
		{{$index->render()}}
	</div>
</div>
@endsection