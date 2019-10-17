<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $fillable = [
	        'cod_acceso',
			'wacceso',
			'accesos',
			'generales',
			'titulos',
			'competencias',
			'contenidos',
			'sumillas',
			'estrategias',
			'evaluaciones',
			'bibliografias',
			'unidades',
			'cursos',
			'mallas',
			'mcursos',
			'prereqs',
			'grupos',
			'curso_grupos',
			'curso_competencia',
    ];	
}
