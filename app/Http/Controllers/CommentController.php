<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index($post_id)
    {
      $comments = \App\Comment::where('post_id',$post_id)->with('user')->latest()->get();
      return response()->json(['data'=>$comments, 'status'=>'success'],200);
    }

    public function store(Request $request,$post_id)
    {
      try {
        $comment = \App\Comment::create([
          'body'    => $request->body,
          'user_id' => \Auth::id(),
          'post_id' => $post_id
        ]);
        $comment = \App\Comment::whereId($comment->id)->with('user')->first();
        return response()->json(['data'=>$comment, 'status'=>'success'],200);
      } catch (\Exception $e) {
        return response()->json(['data'=>$e->getMessage(), 'status'=>'error'],500);
      }

    }
}
