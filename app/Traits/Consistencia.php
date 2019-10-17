<?php

namespace App\Traits;

use App\Bibliografia;
use App\Contenido;
use App\Curso;
use App\Estrategia;
use App\Sumilla;
use App\Unidad;

trait Consistencia
{
	public function checkear($curso_id, $type)
	{
		$consistencia = [];
		$incompleto = 0;
		$curso = Curso::find($curso_id);
		/* Sumilla */
		$sumilla = Sumilla::where('plan', env("PLAN"))
							->where('cod_curso', $curso->cod_curso)->first();
		if(is_null($sumilla)){
			array_push($consistencia, ['campo'=>'sumilla', 
										'texto' => 'No se ha ingresado el texto de la SUMILLA.']);
			$incompleto++;
		}else{
			array_push($consistencia, ['campo'=>'sumilla', 
										'texto' => 'ok']);
		}
		/* Unidades */
		$unidades = Unidad::where('semestre', env("SEMESTRE"))
							->where('cod_curso', $curso->cod_curso)->get();
		if($unidades->count() < 2){
			array_push($consistencia, ['campo'=>'unidades', 
										'texto' => 'No se ha ingresado por lo menos 2 UNIDADES.']);
			$incompleto++;
		}else{
			array_push($consistencia, ['campo'=>'unidades', 
										'texto' => 'ok']);
		}
		/* Contenidos */
		foreach ($unidades as $unidad) {
			$contenidos = Contenido::where('semestre', env("SEMESTRE"))
							->where('cod_curso', $curso->cod_curso)
							->where('semana', $unidad->semana)->get();
			if($contenidos->count() == 0){
				array_push($consistencia, ['campo'=>'contenido '.$unidad->semana, 
											'texto' => 'No se ha ingresado CONTENIDO en la unidad ' . $unidad->texto . '.']);
				$incompleto++;
			}else{
				array_push($consistencia, ['campo'=>'contenido '.$unidad->semana, 
											'texto' => 'ok']);
			}
		}
		/* Estrategia */
		$estrategia = Estrategia::where('semestre', env("SEMESTRE"))
							->where('cod_curso', $curso->cod_curso)->first();

		if(is_null($estrategia)){
			array_push($consistencia, ['campo'=>'estrategia', 
										'texto' => 'No se ha ingresado el texto de las ESTRATEGIAS METODOLÓGICAS.']);
			$incompleto++;
		}else{
			array_push($consistencia, ['campo'=>'estrategia', 
										'texto' => 'ok']);
		}

		/* Bibliografia */
		$year_limit = date('Y')-3;

		$bibliografia = Bibliografia::where('semestre', env("SEMESTRE"))
							->where('cod_curso', $curso->cod_curso)
							->where('year', '>', $year_limit)
							->get();

		if($bibliografia->count() < 2){
			array_push($consistencia, ['campo'=>'bibliografia', 
										'texto' => 'No se ha ingresado por lo menos 2 BIBLIOGRAFÍAS con menos de 3 años de antiguedad.']);
			$incompleto++;
		}else{
			array_push($consistencia, ['campo'=>'bibliografia', 
										'texto' => 'ok']);
		}

		if($type == 'array'){
			return $consistencia;
		}else{
			return ($incompleto === 0);
		}


	}    

}