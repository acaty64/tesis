<?php

namespace App\Http\Controllers\Sys;

use App\Bibliografia;
use App\Contenido;
use App\Estrategia;
use App\Evaluacion;
use App\General;
use App\Http\Controllers\Controller;
use App\Responsable;
use App\Unidad;
use App\UserGrupo;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = General::all()->groupBy('semestre');
        $semestres = ['nuevo semestre'];
        foreach ($grupos as $key => $value) {
            array_push($semestres, $key);
        }
        sort($semestres);

// dd($semestres);
        return view('semestre.index')
            ->with('semestres', $semestres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $semestre = $request->semestre;
        $new_semestre = $request->new_semestre;

        if($semestre != "nuevo semestre"){
            $key = 'SEMESTRE';
            $value = "'".$semestre."'";
            $this->changeEnvironmentVariable($key,$value);
            flash('Semestre Activo: ' . $semestre)->success();
            return back();
        }

        if(strlen($new_semestre) == 5 && $semestre == "nuevo semestre"){
            // Verifica si existe anteriormente
            $anterior = General::where('semestre',$new_semestre)->get();
            if($anterior->count()>0){
                flash($new_semestre.' ya existe!!!')->error();
                return back();
            }

            $semestre_old = env('SEMESTRE');
            // Copia los registros
            $antes = General::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $antes = Unidad::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $antes = Contenido::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $antes = Estrategia::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }
            
            $antes = Evaluacion::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $antes = Bibliografia::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $antes = Responsable::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $antes = UserGrupo::where('semestre', $semestre_old)->get();
            foreach ($antes as $registro) {
                $newRegistro = $registro->replicate();
                $newRegistro->semestre = $new_semestre;
                $newRegistro->save();
            }

            $key = 'SEMESTRE';
            $value = "'".$new_semestre."'";
            // dd('$this->changeEnvironmentVariable($key,$value)');
            $this->changeEnvironmentVariable($key,$value);

            flash('Semestre Activo: ' . $new_semestre)->success();
            return back();
        }
        flash($new_semestre.' debe tener 5 caracteres!!!')->error();
        return back();

    }

    private static function changeEnvironmentVariable($key,$value) 
    { 
        $path = base_path('.env'); 
        if(is_string(env($key))) { 
            $old = "'".env($key)."'"; 
            if (file_exists($path)) { 
                file_put_contents($path, str_replace( "$key=".$old, "$key=".$value, file_get_contents($path) )); 
            } 
        } 

    } 
}

