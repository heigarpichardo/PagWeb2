@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tasas de Itbis <a href="Tasaitbis/create"> <button class="btn btn-success">Crear</button></h3></a>
		@include('Mantenimientos.Tasaitbis.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Descripcion</th>
					<th>Tasa</th>
				</thead>
				@foreach($tasa_itbis as $cat)
				<tr>
					<td>{{ $cat->codigo_tasa}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>{{ $cat->tasa}}</td>
					<td>
						<a href="{{URL::action('TasaItbisController@edit',$cat->codigo_tasa)}}"><button class="btn btn-info">Editar</button></a>
						<!--<a href="" data-target="#modal-delete-{{$cat->codigo_tasa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>-->
					</td>
				</tr>
				@include('Mantenimientos.Tasaitbis.modal')
				@endforeach
			</table>
		</div>
		{{$tasa_itbis->render()}}
	</div>
</div>
@endsection