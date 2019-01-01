<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::paginate(25);
      return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'title' => 'required|max:255',
        'body' => 'required',
      ]);

      $user = Auth::user();

      $post = $user->posts()->create([
        'title' => $request->title,
        'body' => $request->body,
      ]);

      return redirect()->route('posts.show', $post->id)->with(['message'=>'Post was Added Successfuly' , 'class'=>'success']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::findOrFail($id);
      return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);
      return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'title' => 'required|max:255',
        'body' => 'required',
      ]);

      $post = Post::findOrFail($id);
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();

      return redirect()->route('posts.show', $post->id)->with(['message'=>'Post Updated Successfuly', 'class'=>'success' ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Post::destroy($id);
      return redirect()->route('posts.index')->with(['message'=>'Post Deleted Successfuly', 'class'=>'success']);
    }
}
