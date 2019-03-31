@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <!--<a href="Ventas/create"> <button class="btn btn-success">Crear</button>--></h3></a>
		@include('procesos.Ventas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Documento</th>
					<th>Balance</th>
				</thead>
				@foreach($index as $cat)
				<tr>
					<td>{{ $cat->codigo_cliente}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->apellido}}</td>
					<td>{{ $cat->documento}}</td>
					<td>{{ $cat->balance}}</td>
					<td>
						<a href="{{URL::action('VentasController@create',$cat->codigo_cliente)}}"><button class="btn btn-info">Seleccionar</button></a>
						<!--<a href="{{URL::action('VentasController@edit',$cat->codigo_cliente)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->codigo_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>-->
					</td>
				</tr>
				@include('procesos.Ventas.modal')
				@endforeach
			</table>
		</div>
		{{$index->render()}}
	</div>
</div>
@endsection