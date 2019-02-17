@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Concepto</h3>
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
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			{!!Form::open(array('url'=>'procesos/inscripcion','method'=>'POST','autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="Descripcion">Descripcion</label>
				<!<input type="memo" value="" name="descripcion" class="form-control" placeholder="Descripcion...">
				<textarea rows="2" cols="5" wrap="soft" name="descripcion" class="form-control" placeholder="Descripcion..."></textarea>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="ano_escolar">Tipos de Itbis</label>
				<!<input type="text" name="id_año_escolar" class="form-control">
				<select size=1 name="itbis" class="form-control" placeholder="Itbis...">
				  <option value="tortilla">18%</option>
				  <option value="paella">16%</option>
				  <option value="pizza">No Itbis</option>
				</select>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
