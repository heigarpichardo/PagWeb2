@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					<?php foreach ($errors->all() as $error){ ?>
					<li>{{$error}}</li>
				<?php } ?>

				</ul>
			</div>
			@endif

			{!!Form::model($edit,['method'=>'PATCH','route'=>['Clientes.update',$edit->codigo_cliente]])!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" placeholder="nombre..." value="{{$edit_personas->nombre}}">
			</div>
			<div class="form-group">
				<label for="nombre">Apellido</label>
				<input type="text" name="apellido" class="form-control" placeholder="apellido..." value="{{$edit->apellido}}">
			</div>
			<div class="form-group">
				<label for="nombre">Documento</label>
				<input type="text" name="documento" class="form-control" placeholder="documento...">
			</div>
			<div class="form-group">
				<label for="nombre">Tipo de Telefono</label>
				<select name="tipo_telefono" class="form-control" style="width: 100px">
					<?php foreach ($tipo_telefono as $cat) {  ?>
						<option value= "{{$cat->codigo_tipo_telefono}}"> {{$cat->descripcion}} </option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="nombre">Telefono</label>
				<input type="text" name="telefono" class="form-control" placeholder="telefono...">
			</div>
			<div class="form-group">
				<label for="nombre">Tipo NCF</label>
				<input type="text" name="tipo_NCF" class="form-control" placeholder="tipo...">
			</div>
		<!--	<div class="form-group">
				<label for="nombre">Balance</label>
				<input type="text" name="balance" class="form-control" placeholder="balance...">
			</div> -->
				<div class="form-group">
				<label for="nombre">Limite de Credito</label>
				<input type="text" name="Limite_credito" class="form-control" placeholder="limite de credito..." value="{{$edit->limite_credito}}">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
