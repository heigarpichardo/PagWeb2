@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Servicio</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					<?php foreach ($errors->all() as $error){ ?>
					<li>{{$error}}</li>
				<?php } ?>

				</ul>
			</div>
			@endif

			{!!Form::model($edit,['method'=>'PATCH','route'=>['Servicios.update',$edit->codigo_servicio]])!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" value="{{$edit->descripcion}}">
			</div>

			<div class="form-group">
				<label>Tipo de Telefono</label>
				<select name="tipo_telefono" class="form-control" style="width: 100px">
					<?php foreach ($tipo_telefono as $cat) {  ?>
						<?php if($cat->tipo_telefono == $edit->tipo_telefono){ ?>
						<option value= "{{$cat->tipo_telefono}}" selected>{{$cat->descripcion}}</option>
						<?php } else{ ?>
						<option value= "{{$cat->tipo_telefono}}"> {{$cat->descripcion}} </option>
						<?php } ?>
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
