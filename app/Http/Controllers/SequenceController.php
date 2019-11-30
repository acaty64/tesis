<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Sequence;
use App\User;
use Illuminate\Http\Request;

class SequenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $thesisId = null)
    {
        $sequence = Sequence::findOrFail($id);
        $dealId = $sequence->deal_id;
        $deal = Deal::findOrFail($dealId);
        $function = $deal->fdata;
        $request = ['dealId'=> $dealId, 'thesisId' => $thesisId];
        $data = $this->$function($request);
        $blade = $data['deal']['view'];
        return view($blade)->with('data', $data);
    }

    private function dataAuthorBlade($request)
    {
        $dealId = $request['dealId'];
        $users = User::get()->filter(function($item) {
                    return $item->tuser === 'Autor';
                 });
        $users_sort = $users->sortBy('name');
        $authors = $users_sort->map(function ($user) {
                        return $user->only(['id', 'name', 'email']);
                    });
        $deal = Deal::findOrFail($dealId);
        $blade = $deal->view;
        $data = [
            'authors' => $authors,
            'deal' => $deal,
            'blade' => $blade,
        ];
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
