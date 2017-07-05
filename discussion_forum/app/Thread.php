<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
//use App\Topic;
use App\User;

class Thread extends Model
{
	//protected $primaryKey = 'id';
	protected $guarded = [];
   public function replies()
   {
   		return $this->hasMany(Reply::class);
   }
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function addReply($reply)
   {
    
      $reply=$this->replies()->create($reply);

      return $reply;
       

   }
}
