@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Tipo de Servicios</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				<?php foreach ($errors->all() as $error){ ?>
					<li>{{$error}}</li>
				<?php } ?>
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'Mantenimientos/Servicios','method'=>'POST','autocomplete'=>'off', 'files'=>'true'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" placeholder="Descripcion...">
			</div>
				<div class="form-group">
				<label>Tasas</label>
				<select name="codigo_tasa" class="form-control" style="width: 100px">
					<?php foreach ($tasa_itbis as $cat) {  ?>
						<option value= "{{$cat->codigo_tasa}}"> {{$cat->descripcion}} </option>
					<?php } ?>
				</select>
			</div> 
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
