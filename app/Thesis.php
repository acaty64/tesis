<?php

namespace App;

use App\Author;
use App\Deal;
use App\Sequence;
use App\Trace;
use App\Tuser;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $fillable = [
        'serie', 'application'
    ];

    protected $appends = [
        'author', 
        'title',
        'nextSequence' ,
        'user_active', 
        'advisor_active',
    ];

    public function getNextSequenceAttribute($value='')
    {
        $traces = Trace::where('thesis_id', $this->id)->get();
        $lastSequence = $traces->sortByDesc('id')->first();
        $nextId = $lastSequence->sequence_id;
        $nextSequence = Sequence::findOrFail($nextId)->next;
        $applySequence = Sequence::where('sequence', $nextSequence)->first();
        return $applySequence;
    }

    public function getAuthorIdAttribute()
    {
    	$author = Author::where('thesis_id', $this->id)->first();
    	return $author->user_id;
    }

    public function getAuthorAttribute()
    {
        $author = Author::where('thesis_id', $this->id)->first();
        return $author->name;
    }

    public function getTitleAttribute()
    {
    	$titles = Title::where('thesis_id', $this->id)->get();
        $title = $titles->sortByDesc('id')->first();
    	return $title->title;
    }

    public function getUserActiveAttribute()
    {
        $traces = Trace::where('thesis_id', $this->id)->get();
        $applySequence = $this->nextSequence;
        // $lastSequence = $traces->sortByDesc('date')->first()->sequence_id;
        // $nextSequence = Sequence::findOrFail($lastSequence)->next;
        // $applySequence = Sequence::where('sequence', $nextSequence)->first();
        $deal = Deal::findOrFail($applySequence->deal_id);
        $tuser_id = $deal->tuser_id;
        // $tadvisor_id = $deal->tadvisor_id;
        $tuser = Tuser::findOrFail($tuser_id);
        return $tuser->name;
    }

    public function getAdvisorActiveAttribute()
    {
        $traces = Trace::where('thesis_id', $this->id)->get();
        $applySequence = $this->nextSequence;
        // $lastSequence = $traces->sortByDesc('date')->first()->sequence_id;
        // $nextSequence = Sequence::findOrFail($lastSequence)->next;
        // $applySequence = Sequence::where('sequence', $nextSequence)->first();
        $deal = Deal::findOrFail($applySequence->deal_id);
        // $tuser_id = $deal->tuser_id;
        $tadvisor_id = $deal->tadvisor_id;
        if(is_null($tadvisor_id)){
            return null;
        }else{
            $tadvisor = Tadvisor::findOrFail($tadvisor_id);
            return $tadvisor->name;
        }
    }

}
