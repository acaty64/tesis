<?php

namespace App;

use App\Author;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $fillable = [
        'serie', 'application'
    ];

    protected $appends = ['author', 'title'];

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

}
