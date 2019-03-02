@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipos de Servicios <a href="Servicios/create"> <button class="btn btn-success">Crear</button></h3></a>
		@include('Mantenimientos.Servicios.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Descripcion</th>
					<th>Codigo Tasa</th>
				</thead>
				@foreach($index as $cat)
				<tr>
					<td>{{ $cat->codigo_servicio}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>{{ $cat->codigo_tasa}}</td>
					<td>
						<a href="{{URL::action('ServiciosController@edit',$cat->codigo_servicio)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->codigo_servicio}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Mantenimientos.Servicios.modal')
				@endforeach
			</table>
		</div>
		{{$index->render()}}
	</div>
</div>
@endsection