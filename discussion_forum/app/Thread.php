<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	protected $primaryKey = 'id';
	protected $guarded = [];
   public function replies()
   {
   		return $this->hasMany(Replies::class);
   }
    public function topic()
    {
    	return $this->belongsTo(Topic::class);
    }
}
