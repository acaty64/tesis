<?php

namespace App\Http\Controllers;

use App\Advisor;
use App\Author;
use App\Deal;
use App\Sequence;
use App\Thesis;
use App\Trace;
use App\User;
use Illuminate\Http\Request;

class SequenceController extends Controller
{

  /**
   *  route('sequence.apply', $user_id)
   */
  public function apply($user_id=null)
  {
    if(is_null($user_id))
    {
      $user_id = \Auth::user()->id;
    }
    $user = User::findOrFail($user_id);
    // Recoge el tipo de usuario
    $tipo = $user->tuser;
    // Recoge las tesis pendientes
    switch ($tipo) {
      case 'Autor':
        $thesesByauthor = Author::where('user_id', $user_id)->get();
        $thesis_id = $thesesByauthor->sortByDesc('id')->first()->thesis_id;
        // $request = [
        //     'user_id'=>$user->id, 
        //     'thesis_id' => $lastThesis,
        // ];
        return redirect('sequence/show2/'.$user_id.'/'.$thesis_id);
        // $this->apply2($request);
        break;
      case 'Asesor':
        $ids = Advisor::where('user_id', $user_id)->get();

        $theses = [];
        foreach ($ids as $id) {
          $tadvisor = $id->tadvisor_name;
          $t = Thesis::findOrFail($id->thesis_id);
          if(!is_null($t->advisor_active)){
            $item = [
              'id' => $t->thesis_id,
              'title' => $t->title,
              'author' => $t->author,
              'tadvisor' => $tadvisor,
              'user_id' => $user->id
            ];
            array_push($theses, $item);
          }
        }
        return view('app.thesis.advisor')
              ->with('user', $user)
              ->with('data', $theses);
        break;
      default:
                # code...
      break;
    }
  }

  public function show2($user_id, $thesis_id)
  {
    // $user_id = $request['user_id'];
    // $thesis_id = $request['thesis_id'];

    $thesis = Thesis::findOrFail($thesis_id);
    $nextSequence = $thesis->nextSequence;

    $sequence = Sequence::findOrFail($nextSequence->id);
    $deal_id = $sequence->deal_id;
    $deal = Deal::findOrFail($deal_id);
    $function = $deal->fdata;
    $request = ['deal_id'=> $deal_id, 'thesis_id' => $thesis_id];
    $data = $this->$function($request);
// dd($data);
    $view = $data['deal']['view'];
    return view($view)->with('data', $data);

    // return redirect('sequence/show/'.$nextSequence->id.'/'.$thesis_id);
    // $this->show($nextSequence->id, $thesis->id);
    // return redirect('sequence/show/'.$nextSequence->id.'/'.$thesis->id);
    // $deal = Deal::findOrFail($nextSequence->deal_id);
    // $fData = $deal->fdata;
    // $request = ['deal_id'=>$nextSequence->deal_id, 'thesis_id' => $thesis_id];
    // $data = $this->$fData($request);

    // return redirect('sequence/show/'.$nextSequence->id.'/'.$thesis->id)
    //     ->with('data', $data);
  }

  /**
   *  route('sequence.show', $user_id, $thesisId)
   */
  public function show($sequence_id, $thesis_id = null)
  {
dd('Controller');
    $sequence = Sequence::findOrFail($sequence_id);
    $deal_id = $sequence->deal_id;
    $deal = Deal::findOrFail($deal_id);
    $function = $deal->fdata;
    $request = ['deal_id'=> $deal_id, 'thesis_id' => $thesis_id];
    $data = $this->$function($request);
    $view = $data['deal']['view'];
    return view($view)->with('data', $data);
  }

  /**
   *  route('')
   */
  public function dataUp10Blade($request)
  // protected function dataUp10Blade()
  {
    $deal = Deal::findOrFail($request['deal_id']);
    $thesis = Thesis::findOrFail($request['thesis_id']);
    $author = User::findOrFail($thesis->author_id);
    $data = [
      'deal' => $deal,
      'thesis' => $thesis,
      'author_id' => $author->id
    ];
    return $data;
  }

  /**
   *  route('')
   */
  private function dataAuthorBlade($request)
  {
    $deal_id = $request['deal_id'];
    $users = User::get()->filter(function($item) {
      return $item->tuser === 'Autor';
    });
    $users_sort = $users->sortBy('name');
    $authors = $users_sort->map(function ($user) {
      return $user->only(['id', 'name', 'email']);
    });

    $users = User::get()->filter(function($item) {
      return $item->tuser === 'Asesor';
    });
    $users_sort = $users->sortBy('name');
    $advisors = $users_sort->map(function ($user) {
      return $user->only(['id', 'name', 'email']);
    });

    $deal = Deal::findOrFail($deal_id);
    $data = [
      'advisors' => $advisors,
      'authors' => $authors,
      'deal' => $deal,
    ];

    return $data;
  }

}
