@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipos de Personas <a href="Tipopersona/create"> <button class="btn btn-success">Crear</button></h3></a>
		@include('Mantenimientos.Tipopersona.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Descripcion</th>
				</thead>
				@foreach($Tipo_Persona as $cat)
				<tr>
					<td>{{ $cat->codigo_tipo_persona}}</td>
					<td>{{ $cat->descripcion}}</td>				
					<td>
						<a href="{{URL::action('TipoPersonaController@create',$cat->codigo_tipo_persona)}}"><button class="btn btn-info">Seleccionar</button></a>
					</td>
				</tr>
				@include('Mantenimientos.Tipopersona.modal')
				@endforeach
			</table>
		</div>
		{{$Tipo_Persona->render()}}
	</div>
</div>
@endsection