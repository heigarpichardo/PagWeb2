@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Tasa de Itbis</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($Tasa_Itbis,['method'=>'PATCH','route'=>['Tasaitbis.update',$Tasa_Itbis->codigo_tasa]])!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<input type="text" name="descripcion" value="{{$Tasa_Itbis->descripcion}}" class="form-control" placeholder="Descripcion...">
			</div>
			<div class="form-group">
				<label for="nombre">Tasa</label>
				<input type="number" name="tasa" value="{{$Tasa_Itbis->tasa}}" class="form-control" value="0.00" min="0" step="0.01" placeholder="tasa...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
