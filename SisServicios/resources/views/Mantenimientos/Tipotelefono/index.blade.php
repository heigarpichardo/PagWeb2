@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipos de Telefono <a href="Tipotelefono/create"> <button class="btn btn-success">Crear</button></h3></a>
		@include('Mantenimientos.Tipotelefono.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Descripcion</th>
				</thead>
				@foreach($index as $cat)
				<tr>
					<td>{{ $cat->codigo_tipo_telefono}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>
						<a href="{{URL::action('TipoTelefonoController@edit',$cat->codigo_tipo_telefono)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->codigo_tipo_telefono}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Mantenimientos.Tipotelefono.modal')
				@endforeach
			</table>
		</div>
		{{$index->render()}}
	</div>
</div>
@endsection