<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use Response;
class ThreadsController extends Controller
{
    //
    public function __construct()
     {
        $this->middleware('auth')->except(['index']);
     }
    public function index()
    {
    	$discussions= Thread::latest()->get();//it will fetch all the results in desc order by created_at.
        return $discussions;
         return Response::json([
            'data'=> $discussions->toArray()
            ],200);
    	//return view('Discussion/index',compact('discussions'));
     
    }

     public function getThreadsByTopic($topic)
    {

       
        //DB::table('threads')->where('topic', '=', $topic)->get()
       $discussions=Thread::where('topic',$topic)->get();
       
         return Response::json([
            'data'=> $discussions->toArray()
            ],200);
        //return view('Discussion/index',compact('discussions'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store()
    {
        $this->validate(request(), ['body' => 'required']);
    	Thread::create([
		'body'=>request('body'),
		'topic'=>request('topic'),

		'user_id'=>auth()->id()
         	]);

         return back();
    }

      


     public function delete($id)
    {
       
      $thread = Thread::findorFail($id);
     
        if (auth()->id() != $thread->user_id) {
            $message = 'You can not delete this thread';
            return redirect()->route('home')->with(['message' => $message]);
        }
        $thread->delete();
        return redirect()->route('home')->with(['message' => 'Successfully deleted!']);
    }

      public function update(Thread $thread)
    {
         if (auth()->id() != $thread->user_id) {
            $message = 'You can not update this thread';
            return redirect()->route('threads.detail')->with(['message' => $message]);
            }
        
         $this->validate(request(), ['body' => 'required']);

            $thread->body = Input::get('body');
            $thread->save();

            return redirect()->route('threads.detail');
    }
 
}
