<?php

namespace App\Http\Controllers;

use App\Acceso;
use App\User;
use App\UserAcceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }


    public function index()
    {
        $users_all = User::where('id','>',3);
        $users_sort = $users_all->orderBy('name');
        $users = $users_sort->paginate(10);
        return view('app.users.index')
                ->with('users', $users);
    }

    public function password($user_id)
    {
        return redirect('/enConstruccion');
    }

    public function acceso($user_id)
    {
        return redirect('/enConstruccion');
    }

    public function create()
    {
        return redirect('/enConstruccion');
    }

    public function store(Request $request)
    {
        return redirect('/enConstruccion');
        $user = $request->user;
        $new_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'cod_doc' => $user->cod_doc,
                'password' => bcrypt($user->password)
            ]);
        flash('El usuario ' . $user->name . ' ha sido creado con éxito.')->success();
        return redirect()->route('users.index');
    }

    public function show($user_id)
    {
        //
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        if(Auth::user()->acceso->wacceso == 'Master'){
            $accesos = Acceso::all();
        }else{
            $accesos = Acceso::where('cod_acceso','!=', 'master')
                    ->where('cod_acceso', '!=', 'adm')->get();
        }
        return view('app.users.edit')
            ->with('user', $user)
            ->with('accesos', $accesos);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cod_doc = $request->cod_doc;
        $message = 'Los datos del usuario ' . $request->name ;
        if($request->password && ($request->password == $request->confirm)){
            $user->password = bcrypt($request->password);
            $message = 'El password del usuario ' . $request->name ;
        }
        $user->save();
        /* Modificar UserAcceso */
        $acceso = $user->user_acceso;
        $acceso->acceso_id = $request->acceso_id;
        $acceso->save();
        flash($message . ' ha sido modificado con éxito.')->success();
        return redirect()->route('users.index');
    }

    public function destroy($user_id)
    {    
        $user = User::findOrFail($user_id);
        $acceso = UserAcceso::where('user_id', $user_id)->first();
        $acceso->delete();
        $user->delete();
        flash('El usuario ' . $user->name . ' ha sido eliminado con éxito.')->success();
        return redirect()->route('users.index');
    }
}
