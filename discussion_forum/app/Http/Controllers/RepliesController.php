<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use Response;

class RepliesController extends Controller
{
    //
     public function __construct()
	  {
	      $this->middleware('auth')->except(['index']);
	  }

     public function index($id)
    {
    	$replies= Reply::where('thread_id',$id)->get();
        
        return Response::json([
            'data'=> $replies->toArray()],200);
    	//return view('Discussion/details',compact('replies'));
     
    }

    public function store(Thread $thread)
    {
         $this->validate(request(), ['body' => 'required']);
          $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);
            return back();
    }


    
    public function delete(Reply $reply)
    {
       
     
        if (auth()->id() != $reply->user_id) {
            $message = 'You can not delete this answer';
            return redirect()->route('threads.detail')->with(['message' => $message]);
        }
        $reply->delete();
        return redirect()->route('threads.detail')->with(['message' => 'Successfully deleted!']);
    }

    public function update(Reply $reply)
    {
         if (auth()->id() != $reply->user_id)
        {
            $message = 'You can not update this answer';
            return redirect()->route('threads.detail')->with(['message' => $message]);
        }
        
         $this->validate(request(), ['body' => 'required']);

            $reply->body = Input::get('body');
            $reply->save();

            return redirect()->route('threads.detail');
    }
 
}
