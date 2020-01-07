<?php

namespace App\Http\Controllers;

use App\Advisor;
use App\Author;
use App\Deal;
use App\Email;
use App\Http\Controllers\EmailController;
use App\Sequence;
use App\Thesis;
use App\Title;
use App\Trace;
use App\Tuser;
use App\Tuser_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class ThesisController extends Controller
{
    /**
     * route('thesis.index')
     */
    public function index()
    {
        $theses = Thesis::where('id','>','0')->orderByDesc('id');

        $data = $theses->paginate(5);
        return view('app.theses.index')->with('data', $data);
    }

    /**
     * route('thesis.create')
     */
    public function create()
    {
        return redirect(route('sequence.show',1));
    }

    /**
     * route('thesis.store')
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($data['author_id'] == 0){
            Flash::error("Debe seleccionar el autor");
            return Redirect::back()->withInput();
        }else{
            $sequence = Sequence::where('sequence',1)->first();
            // $application = $data['application'];
            // $author_id = $data['author_id'];
            // $title = $data['title'];
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
                    'application' => $data['application'],
                ]);
                // Graba title
                $title = Title::create([
                    'thesis_id' => $thesis->id,
                    'title' => $data['title']
                ]);
                // Graba author
                $author = Author::create([
                    'thesis_id' => $thesis->id,
                    'user_id' => $data['author_id']
                ]);
                // Graba advisor
                $advisor = Advisor::create([
                    'thesis_id' => $thesis->id,
                    'user_id' => $data['advisor_id'],
                    'tadvisor_id' => $data['tadvisor_id']
                ]);
            } catch (Exception $e) {            
                Flash::error("Error en la creacion del registro. 1");
                return Redirect::back()->withInput();
            }
            try {
                // Selecciona $deal
                $deal = Deal::findOrFail($sequence->deal_id);
                // Calcula $tuser_id ['Autor']
                $tuser_id = Tuser::where('name', 'Autor')->first()->id;
                // Graba información [tuser_id, user_id] en Tuser_user
                $last = Tuser_user::where('user_id', $data['author_id'])->where('tuser_id', $tuser_id)->get();
                if(count($last)==0){
                    $Tuser_user = Tuser_user::create([
                        'user_id' => $data['author_id'],
                        'tuser_id' => $tuser_id,
                    ]);
                }
            } catch (Exception $e) {
                Flash::error("Error en la creacion del registro. 2");
                return ['success' => false];
            }
            try {
                $root = storage_path('app/public');
                $newDir = $root . '/' . $thesis->id;
                if(!file_exists($newDir)){
                    mkdir($newDir, 0777, true);
                }
            } catch (Exception $e) {
                Flash::error("Error en la creación del directorio " . $newDir);
                return redirect(route('thesis.index'));                
            }
            try {
                // Graba información [deal_id, date(), from_user_id, to_user_id1 ] en Emails
                $user_id = Auth::id();
                $email = Email::create([
                    'deal_id' => $sequence->deal_id,
                    'date' => Carbon::today()->toDateTimeString(),
                    'from_user_id' => $user_id,
                    'to_user1_id' => 3,
                    'temail_id' => $deal->temail_id,
                ]);
                // Envia el correo electrónico
                $emailController = new EmailController();
                $result = $emailController->send($email);
                // Graba trace
                $trace = Trace::create([
                    'thesis_id' => $thesis->id,
                    'sequence_id' => $sequence->id,
                    'date' => Carbon::today()->toDateTimeString(),
                ]);
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
     * route('thesis.edit')
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
     * route('thesis.update')
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $sequence = Sequence::where('sequence',$data['thesis_id'])->first();
        try {
            $thesis = Thesis::findOrFail($data['thesis_id']);
            // Graba información [ application] en Theses
            $thesis->application = $data['application'];
            $thesis->save();
        } catch (Exception $e) {            
            Flash::error("Error en la modificacion del registro. 1");
            return Redirect::back()->withInput();
        }
        try {
            // Cambia en Title
            $titles = Title::where('thesis_id', $data['thesis_id'])->get();
            $title = $titles->sortByDesc('id')->first();
            $title->title = $data['title'];
            $title->save();
        } catch (Exception $e) {
            Flash::error("Error en la modificacion del registro. 2");
            return ['success' => false];
        }
        try {
            // Cambia en Author
            if($data['oldAuthor_id'] != $data['author_id']){
                $oldAuthor = Author::where('thesis_id', $data['thesis_id'])
                            ->where('user_id', $data['oldAuthor_id'])->first();
                $oldAuthor->user_id = $data['author_id'];
                $oldAuthor->save();
            }
        } catch (Exception $e) {
            Flash::error("Error en la modificacion del registro. 3");
            return ['success' => false];
        }
        try {
            // Cambia en Advisor
            $advisor = Advisor::where('thesis_id', $data['thesis_id'])
                            ->where('tadvisor_id', $data['tadvisor_id'])->first();
            $advisor->user_id = $data['advisor_id'];
            $advisor->save();
        } catch (Exception $e) {
            Flash::error("Error en la modificacion del registro. 3");
            return ['success' => false];
        }

        try {
            // Selecciona $deal
            $deal = Deal::findOrFail($sequence->deal_id);
            // Graba información [deal_id, date(), from_user_id, to_user_id1 ] en Emails
            $user_id = \Auth::user()->id;
            $email = Email::create([
                'deal_id' => $sequence->deal_id,
                'date' => Carbon::today()->toDateTimeString(),
                'from_user_id' => $user_id,
                'to_user1_id' => $data['author_id'],
                'temail_id' => $deal->temail_id,
            ]);
            // Envia el correo electrónico
            $emailController = new EmailController();
            $result = $emailController->send($email);
            // Graba trace
            $trace = Trace::create([
                'thesis_id' => $data['thesis_id'],
                'sequence_id' => $sequence->id,
                'date' => Carbon::today()->toDateTimeString(),
            ]);
        } catch (Exception $e) {
            Flash::error("Error en el envio del correo electronico");
            return redirect(route('thesis.index'));
        }
        Flash::success("Correo electronico enviado");
        Flash::success("Registro grabado, el autor puede subir su documento");
        Flash::error("WORKING ...");
        return Redirect::route('thesis.index');        
    }

    /**
     * route('thesis.destroy')
     */
    public function destroy($id)
    {
        $thesis = Thesis::findOrFail($id);
        $thesis->delete();
        $authors = Author::where('thesis_id', $thesis->id)->get();
        foreach ($authors as $author) {
            $author->delete();
        }
        $titles = Title::where('thesis_id', $thesis->id)->get();
        foreach ($titles as $title) {
            $title->delete();
        }
        $advisors = Advisor::where('thesis_id', $thesis->id)->get();
        foreach ($advisors as $advisor) {
            $advisor->delete();
        }
        Flash::error("Registro eliminado. Solicitud ".$thesis->application." ".$title->title);
        Flash::error("WORKING ...");
        return Redirect::route('thesis.index');
    }

}
