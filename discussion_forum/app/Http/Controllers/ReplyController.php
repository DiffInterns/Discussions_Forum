<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //
     public function __construct()
	  {
	      $this->middleware('auth')->except(['index']);;
	  }

     public function index($id)
    {
    	$replies= Replies::find('thread_id',$id);
    	return view('Discussion/details',compact('replies'));
     
    }
    public function delete($id)
    {
       
      $reply = Replies::find($id);
     
        if (auth()->id() != $reply->user_id) {
            $message = 'You can not delete this answer';
            return redirect()->route('threads.detail')->with(['message' => $message]);
        }
        $reply->delete();
        return redirect()->route('threads.detail')->with(['message' => 'Successfully deleted!']);
    }
}
