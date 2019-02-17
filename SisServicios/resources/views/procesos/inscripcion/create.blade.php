@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Inscripcion</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			{!!Form::open(array('url'=>'procesos/inscripcion','method'=>'POST','autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="id_estudiante">Estudiante</label>
				<input type="text" value="" name="id_estudiante" class="form-control" placeholder="ID Estudiante...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="Nombre Estudiante">Estudiante</label>
				<input type="text" value="" name="estudiante" class="form-control" placeholder="ID Estudiante...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="date" name="fecha_inscripcion" class="form-control" placeholder="Fecha...">
			</div>
			<div class="form-group">
				<label for="ano_escolar">Año Escolar</label>
				<input type="text" name="id_año_escolar" class="form-control">
			</div>
			<div class="form-group">
				<label for="nivel">Nivel</label>
				<input type="text" name="id_nivel" class="form-control" placeholder="ID Nivel...">
			</div>
			<div class="form-group">
				<label for="monto">Monto</label>
				<input type="number" name="monto" class="form-control" value="0.00" min="0" step="0.01" >
			</div>
			<div class="form-group">
				<label for="descuento">Descuento</label>
				<input type="number" name="descuento" class="form-control" value="0.00" min="0" step="0.01" >
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
