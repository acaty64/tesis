<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmailController; 

use App\Author;
use App\Deal;
use App\Email;
use App\Sequence;
use App\Thesis;
use App\Title;
use App\Trace;
use App\Tuser;
use App\Tuser_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theses = Thesis::where('id','>','0')->orderByDesc('id');

        $data = $theses->paginate(5);
        return view('app.theses.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(route('sequence.show',1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($data['author_id'] == 0){
            Flash::error("Debe seleccionar el autor");
            return Redirect::back()->withInput();
        }else{
            $sequence = Sequence::where('sequence',1)->first();
            $application = $data['application'];
            $author_id = $data['author_id'];
            $title = $data['title'];
            try {
                // Calcula $serie
                $series = Thesis::orderByDesc('serie')->first();
                $newSerie = 1;
                if($series){
                    $newSerie = $series->serie + 1;
                }
                // Graba información [serie, application] en Theses
                $thesis = Thesis::create([
                    'serie' => $newSerie,
                    'application' => $application,
                ]);
                // Graba title
                $title = Title::create([
                    'thesis_id' => $thesis->id,
                    'title' => $title
                ]);
                // Graba trace
                $trace = Trace::create([
                    'thesis_id' => $thesis->id,
                    'sequence_id' => $sequence->id,
                    'date' => Carbon::today()->toDateTimeString(),
                ]);
            } catch (Exception $e) {            
                Flash::error("Error en la creacion del registro");
                return Redirect::back()->withInput();
            }
            try {
                //////////////////////////////////////////////////// 
                // Selecciona $deal
                $deal = Deal::findOrFail($sequence->deal_id);
                // Calcula $tuser_id ['Autor']
                $tuser_id = Tuser::where('name', 'Autor')->first()->id;
                // Graba información [tuser_id, user_id] en Tuser_user
                $Tuser_user = Tuser_user::create([
                    'user_id' => $author_id,
                    'tuser_id' => $tuser_id,
                ]);
            } catch (Exception $e) {
                Flash::error("Error en la creacion del registro");
                return ['success' => false];
            }
            try {
                // Graba información [deal_id, date(), from_user_id, to_user_id1 ] en Emails
                $email = Email::create([
                    'deal_id' => $sequence->deal_id,
                    'date' => $trace->date,
                    'from_user_id' => $author_id,
                    'to_user1_id' => 3,
                    'temail_id' => $deal->temail_id,
                ]);
                // Envia el correo electrónico
                $emailController = new EmailController();
                $result = $emailController->send($email);
            } catch (Exception $e) {
                Flash::error("Error en el envio del correo electronico");
                return redirect(route('thesis.index'));
            }
            Flash::success("Correo electronico enviado");
            Flash::success("Registro grabado, el autor puede subir su documento");
            Flash::error("WORKING ...");
            return Redirect::route('thesis.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thesis = Thesis::findOrFail($id);
        $author = $thesis->author;
        $authorId = $thesis->authorId;
        $title = $thesis->title;
        $users = User::all()->filter(function($item) {
                    return $item->id > 2;
                 });
        $users_sort = $users->sortBy('name');
        $authors = $users_sort->map(function ($user) {
                        return $user->only(['id', 'name', 'email']);
                    });
        $data = [
            'thesis' => $thesis,
            'authors' => $authors,
            'authorId' => $thesis->authorId,
        ];
        return view('app.theses.edit')
            ->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
