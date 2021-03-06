@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sd-6 col-xs-12">
			<h3>Editar registro de personas: {{$persona->nom_persona}} {{$persona->ape_persona}}</h3>

			@if(count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!!Form::model($persona,['method'=>'PATCH','route'=>['registro.persona.update',$persona->id_persona]])!!}
				{{Form::token()}}
				<div class="panel panel-default">
            		<div class="panel-body">
            			<!--Datos de la persona CONCAT_WS(" ", nom_persona, ape_persona)-->
						<div class="form-group">
                     		<label for="tipo_persona">Tipo de persona</label>

                     		{{ Form::select('tipo_persona', ['Estudiante' => 'Estudiante', 'Profesor' => 'Profesor', 'Empleado' => 'Empleado'], null, ['class' => 'form-control'])}}
						</div>

						<div class="form-group">
							<label for="nom_persona">Nombre</label>

							<input type="text" name="nom_persona" class="form-control" value="{{$persona->nom_persona}}" placeholder="Nombre...">
						</div>

						<div class="form-group">
							<label for="ape_persona">Apellido</label>

							<input type="text" name="ape_persona" class="form-control" value="{{$persona->ape_persona}}" placeholder="Apellido...">
						</div>

						<div class="form-group">
							<label for="sexo">Sexo</label>

	                     	{{ Form::select('sexo', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'], null, ['class' => 'form-control']) }}
						</div>

						<div class="form-group">
							<label for="fecha_nac">Fecha de nacimiento</label>

							<input type="date" class="form-control" name="fecha_nac" value="{{$persona->fecha_nac}}">
						</div>

						<div class="form-group">
							<label for="estado_civil">Estado civil</label>

	                     	{{ Form::select('estado_civil', ['Soltero' => 'Soltero/a', 'Casado' => 'Casado/a','Divorciado/a' => 'Divorciado/a'], null, ['class' => 'form-control']) }}
						</div>

						<!--<div class="form-group">
							<input type="checkbox" id="check_dir"><label for="chk_direccion"> Opcion de direccion</label></input>

							<script type="text/javascript">
							 	document.getElementById("check_dir").addEventListener("click",function()
							    {
							        var dir=document.getElementById("dir_opcion");

							        if(dir.style.display=="none") { dir.style.display="block"; }

							        else { dir.style.display="none"; }
							    });
							</script>

							<div class="form-group" id="dir_opcion"  values="id_tipo_dir" style="display: none;">
								<label for="tipo_dir">Tipo de direccion</label>

								<br>
								<label for="calle">Calle</label>
								<input type="text" name="calle" class="form-control" placeholder="Calle...">
							</div>
						</div>-->

						<div class="form-group">
							<button class="btn btn-primary" type="sumit">Guardar</button>
							<button class="btn btn-danger" type="reset">Cancelar</button>
						</div>
					</div>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection