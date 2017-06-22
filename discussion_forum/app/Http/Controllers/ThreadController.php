<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadController extends Controller
{
    //
    public function __construct()
     {
         $this->middleware('auth')->except(['index']);;
     }
    public function index()
    {
    	$discussions= Thread::latest()->get();
    	return view('Discussion/index',compact('discussions'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store()
    {
    	Thread::create([
		'body'=>request('body'),
		'topic'=>request('topic'),

		'user_id'=>auth()->id()
         	]);

         return back();
    }

     public function delete($id)
    {
       
      $thread = Thread::find($id);
     
        if (auth()->id() != $thread->user_id) {
            $message = 'You can not delete this thread';
            return redirect()->route('home')->with(['message' => $message]);
        }
        $thread->delete();
        return redirect()->route('home')->with(['message' => 'Successfully deleted!']);
    }
 
}
