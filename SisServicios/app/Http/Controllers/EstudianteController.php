<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use SisServicios\Http\Requests;
use SisServicios\Http\Requests\EstudianteFormRequest;
use SisServicios\Personas;
use SisServicios\Estudiantes;
use SisServicios\Roles;
use SisServicios\Aulas;
use SisServicios\Niveles;
use DB;

class EstudianteController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));

            /*$id_roles = 1;
            $personas = Personas::whereHas('fnroles', function($query2) use($id_roles) {
            $query2->where('id_roles', $id_roles);})->get();*/

            $estudiantes=DB::table('estudiante as e')
            ->join('persona as p','e.id_persona','=','p.id_persona')
            ->join('aula','e.id_aula','=','aula.id_aula')
            ->join('seccion','aula.id_seccion','=','seccion.id_seccion')
            ->join('nivel','aula.id_nivel','=','nivel.id_nivel')
            ->select('e.id_estudiante as id_estudiante','p.nom_persona as nombre','p.ape_persona as apellido','aula.descripcion as aula','seccion.descripcion as seccion','nivel.descripcion as nivel','e.matricula as matricula','e.estudiante_reg as registro')
            ->where(DB::raw('CONCAT_WS(" ", p.nom_persona, p.ape_persona)'),'LIKE','%'.$query.'%')
            ->orderBy('e.id_estudiante','desc')
            ->paginate(7);

            return view('registro.estudiante.index',["estudiantes" => $estudiantes,"searchText" => $query]);
        }
    }
    public function show($id)
    {
        return view("registro.estudiante.show",["estudiante"=>Estudiantes::findOrFail($id)]);
    }
    public function create()
    {
        $personas=DB::table('persona')->where('id_condicion','=','1')->get();
        return view("registro.estudiante.create",["personas"=>$personas]);
    }
    public function store(EstudianteFormRequest $request)
    {
        try
        {
            $persona=new Personas;
            $persona->nom_persona=$request->get('nom_persona');
            $persona->ape_persona=$request->get('ape_persona');
            $persona->sexo=$request->get('sexo');
            $persona->fecha_nac=$request->get('fecha_nac');
            $persona->estado_civil=$request->get('estado_civil');
            $persona->id_condicion=(1);
            $persona->save();

            if($persona->save())
            {
                $estudiante=new Estudiantes;
                $estudiante->id_aula=$request->get('id_aula');
                $estudiante->matricula=$request->get('matricula');
                $estudiante->clave=$request->get('clave');
                $estudiante->estudiante_reg=$request->get('estudiante_reg');
                $estudiante->save();
            }

            return redirect()->route('registro/estudiante')->with('info', 'mensaje de éxito de la operación');
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()->route('registro/estudiante')->with('error', 'Lo sentimos ha ocurrido un error');
        }

        //return Redirect::to('registro/estudiante');
    }
    public function edit($id)
    {
        $estudiantes=Estudiantes::findOrFail($id);
        $personas=DB::table('persona')->where('id_condicion','=','1')->get();
        return view("registro.estudiante.edit",["estudiante"=>$estudiantes,"personas"=>$personas]);
    }
    public function update(EstudianteFormRequest $request,$id)
    {
        $persona=Persona::findOrFail($id);
        $persona->tipo_persona=$request->get('tipo_persona');
        $persona->nom_persona=$request->get('nom_persona');
        $persona->ape_persona=$request->get('ape_persona');
        $persona->sexo=$request->get('sexo');
        $persona->fecha_nac=$request->get('fecha_nac');
        $persona->estado_civil=$request->get('estado_civil');

        $personas->fnestudiantes->id_aula=$request->get('id_aula');
        $personas->fnestudiantes->matricula=$request->get('matricula');
        $personas->fnestudiantes->clave=$request->get('clave');
        $personas->fnestudiantes->estudiante_reg=$request->get('estudiante_reg');

        $persona->update();

        return Redirect::to('registro/estudiante');
    }

    public function destroy($id)
    {
        $persona=Persona::findOrFail($id);
        $persona->id_condicion='2';
        $persona->update();

        return Redirect::to('registro/persona');
    }
}
