@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Facturacion de Servicios</h3>
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
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
			{!!Form::open(array('url'=>'procesos/inscripcion','method'=>'POST','autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label>Estudiante</label>
				<input type="text" value="" name="Cliente" class="form-control" placeholder="Cliente...">
			</div>
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="date" name="fecha_inscripcion" class="form-control" placeholder="Fecha...">
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Servicio</label>
					<input type="text" value="" name="Servicio" class="form-control" placeholder="Servicio...">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="monto">Monto</label>
					<input type="number" name="monto" class="form-control" value="0.00" min="0" step="0.01" >
				</div>
			</div>
			<button class="btn btn-success">Inscripcion</button>
		</div>
	</div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color:#A9D0f5">
									<th>ID</th>
									<th>Servicio</th>
									<th>Monto</th>
									<th>Itbis</th>
									<th>Total</th>
								</thead>
								<tfoot>
									<th>Total</th>
									<th></th>
									<th></th>
									<th></th>
									<th><h4 id="total">S/. 0.00</h4></th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
			{!!Form::close()!!}
	</div>
@endsection
