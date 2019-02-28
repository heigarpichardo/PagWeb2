@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Tipo de Persona</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($Tipo_Persona,['method'=>'PATCH','route'=>['Tipopersona.update',$Tipo_Persona->codigo_tipo_persona]])!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" value="{{$Tipo_Persona->descripcion}}" placeholder="Descripcion...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
