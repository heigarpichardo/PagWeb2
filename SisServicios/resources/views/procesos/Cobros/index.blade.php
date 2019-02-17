@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Cobros <a href="cobros/create"> <button class="btn btn-success">Nuevo</button></h3></a>
		@include('procesos.cobros.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Ciudad</th>
				</thead>
				@foreach($ciudades as $cat)
				<tr>
					<td>{{ $cat->id_ciudad}}</td>
					<td>{{ $cat->ciudad}}</td>
					<td>
						<a href="{{URL::action('CiudadController@edit',$cat->id_ciudad)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->id_ciudad}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('direccion.ciudades.modal')
				@endforeach
			</table>
		</div>
		{{$ciudades->render()}}
	</div>
</div>
@endsection