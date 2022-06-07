<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title','content','slug','category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');    //ci ritorna un oggetto
    }

    public function tags()  //un post può avere più tag ed ecco perchè uso il plurale
    {
        return $this->belongsToMany('App\Tag'); //ci ritorna un array
    }
}
