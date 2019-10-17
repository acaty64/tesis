<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    public function index()
    {
    	$text = $this->transfer('','','');
    	dd($text);
    }

    public function transfer($cod_curso, $status, $archivo)
    {
    	$file_name = "20191-A-150285-SYL.pdf";
    	$file_name = ".gitignore";
    	// $path_name = Storage::response("output/$file_name");
    	return Storage::response(public_path().'/output/'.$file_name);
    	return Storage::response(base_path('storage/output/').$file_name);
    	return base_path('storage/output/').$file_name;
    	// return Storage::response("output/$file_name");
    }
}
