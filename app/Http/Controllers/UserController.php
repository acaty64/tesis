<?php

namespace App\Http\Controllers;

use App\Acceso;
use App\Tuser;
use App\Tuser_user;
use App\User;
use App\UserAcceso;
use App\UserDetail;
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

    public function create()
    {
        if(Auth::user()->tuser == 'Master'){
            $tipos = Tuser::all();
        }else{
            $tipos = Tuser::where('name','!=', 'Master')
                            ->where('name', '!=', 'Administrador')
                            ->get();
        }
        return view('app.users.create')
            ->with('tipos', $tipos);
    }

    public function store(Request $request)
    {
// dd(validator($request->all()));
        // $check1 = User::where('email', $request->email)->first();
        // $check2 = UserDetail::where('codigo', $request->codigo)->first();

        // if($check1){
        //     $old = $check1->name;
        //     flash('El correo electrónico ' . $request->email . ' ya está registrado con el usuario ' . $old)->success();
        //     return redirect()->route('users.index');            
        // }
        // if($check2){
        //     $old = $check2->user->name;
        //     flash('El código ' . $request->codigo . ' ya está registrado con el usuario '. $old)->success();
        //     return redirect()->route('users.index');            
        // }

        $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        // UserDetail::create([
        //     'user_id' => $newUser->id,
        //     'fono' => $request->fono,
        //     'codigo' => $request->codigo
        // ]);
        // Tuser_user::create([
        //     'user_id' => $newUser->id,
        //     'tuser_id' => $request->tuser_id
        // ]);

        flash('El usuario ' . $request->name . ' ha sido creado con éxito.')->success();
        return redirect()->route('users.index');

    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('app.users.show')->with('user', $user);
    }

    public function edit($user_id)
    {
        return view('enConstruccion');
        // $user = User::findOrFail($user_id);
        // if(Auth::user()->tuser == 'Master'){
        //     $accesos = Acceso::all();
        // }else{
        //     $accesos = Acceso::where('cod_acceso','!=', 'master')
        //             ->where('cod_acceso', '!=', 'adm')->get();
        // }
        // return view('app.users.edit')
        //     ->with('user', $user)
        //     ->with('accesos', $accesos);
    }

    public function update(Request $request)
    {
        return view('enConstruccion');
        // $user = User::findOrFail($request->id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->cod_doc = $request->cod_doc;
        // $message = 'Los datos del usuario ' . $request->name ;
        // if($request->password && ($request->password == $request->confirm)){
        //     $user->password = bcrypt($request->password);
        //     $message = 'El password del usuario ' . $request->name ;
        // }
        // $user->save();
        // /* Modificar UserAcceso */
        // $acceso = $user->user_acceso;
        // $acceso->acceso_id = $request->acceso_id;
        // $acceso->save();
        // flash($message . ' ha sido modificado con éxito.')->success();
        // return redirect()->route('users.index');
    }

    public function destroy($user_id)
    {    
        return view('enConstruccion');
        // $user = User::findOrFail($user_id);
        // $acceso = UserAcceso::where('user_id', $user_id)->first();
        // $acceso->delete();
        // $user->delete();
        // flash('El usuario ' . $user->name . ' ha sido eliminado con éxito.')->success();
        // return redirect()->route('users.index');
    }
}
