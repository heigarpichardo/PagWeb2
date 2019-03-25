@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Secuencias de Comprobantes</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				<?php foreach ($errors->all() as $error){ ?>
					<li>{{$error}}</li>
				<?php } ?>
				</ul>
			</div>
			@endif

			{!!Form::model($edit,['method'=>'PATCH','route'=>['Comprobantes.update',$edit->codigo]])!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Serial</label>
				<input type="text" name="serial" class="form-control" placeholder="Serial...">
			</div>
				<div class="form-group">
				<label for="nombre">Tipo</label>
				<input type="text" name="tipo" class="form-control" placeholder="Tipo...">
			</div>
			<div class="form-group">
				<label for="nombre">Secuencia</label>
				<input type="text" name="secuencia" class="form-control" placeholder="Secuencia...">
			</div>
			<div class="form-group">
				<label for="nombre">Final</label>
				<input type="text" name="final" class="form-control" placeholder="Final...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
