@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Estudiantes <a href="inscripcion/create"> <button class="btn btn-success">Inscripcion</button></h3></a>
		@include('procesos.inscripcion.search')
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
					<th>Matricula</th>
				</thead>
				@foreach($estudiantes as $cat)
				<tr>
					<td>{{ $cat->id_estudiante}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->apellido}}</td>
					<td>{{ $cat->matricula}}</td>
					<td>
						<a href="{{URL::action('InscripcionController@create',$cat->id_estudiante)}}"><button class="btn btn-info">Seleccionar</button></a>
					</td>
				</tr>
				@include('procesos.inscripcion.modal')
				@endforeach
			</table>
		</div>
		{{$estudiantes->render()}}
	</div>
</div>
@endsection