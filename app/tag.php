<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    //
	protected $fillable=['id','name'];

	public function posts()
	{
		return $this->hasMany('App\Posts','tag_id');
	}

    public function User()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
