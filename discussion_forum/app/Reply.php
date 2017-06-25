<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thread;

class Replies extends Model
{
    //
    protected $primaryKey = 'id';
	protected $guarded = [];
	
    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

