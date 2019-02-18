@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Condicion</h3>
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
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			{!!Form::open(array('url'=>'procesos/inscripcion','method'=>'POST','autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="Descripcion">Descripcion</label>
				<input type="text" value="" name="descripcion" class="form-control" placeholder="Descripcion...">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="form-group">
				<label>Cantidad de Dias</label>
				<input type="number" name="dia" class="form-control" value="0" min="0" step="1" >
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
