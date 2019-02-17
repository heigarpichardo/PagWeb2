@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h2>Vizualizacion de los estudiantes</h2>
			<br>
			<a href="estudiante/create"><button type="button" class="btn btn-primary btn-block">Registrar nuevo estudiante</button></a>
			<br>
			<h4>Buscar estudiantes</h4>
			@include('registro.estudiante.search')
		</div>
	</div>
	<h2>Listado de Estudiantes</h2>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead class="bg-blue hold-transition skin-blue">
						<th>ID</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Matricula</th>
						<th>Aula</th>
						<th>Seccion</th>
						<th>Nivel</th>
						<th>Fecha de registro</th>
						<th>Opciones</th>
					</thead>

					@foreach($estudiantes as $est)
						<tr>
							<td>{{ $est->id_estudiante}}</td>
							<td>{{ $est->nombre}}</td>
							<td>{{ $est->apellido}}</td>
							<td>{{ $est->matricula}}</td>
							<td>{{ $est->aula}}</td>
							<td>{{ $est->seccion}}</td>
							<td>{{ $est->nivel}}</td>
							<td>{{ $est->registro}}</td>
							<td>
								<a><button type="button" class="btn btn-success">Ver</button></a>
								<a href="{{URL::action('EstudianteController@edit',$est->id_estudiante)}}"><button type="button" class="btn btn-info">Editar</button></a>
								<a><button type="button" class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			{{$estudiantes->render()}}
		</div>
	</div>
@endsection