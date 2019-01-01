@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $post->title }}</h1>
    {{ $post->updated_at->toFormattedDateString() }}
    <hr />
    <p class="lead">
      {{ $post->body }}
    </p>
    <hr />

    <h3>Comments:</h3>
    <div style="margin-bottom:50px;">
      <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" ></textarea>
      <button class="btn btn-success" style="margin-top:10px" >Save Comment</button>
    </div>
    <div class="media" style="margin-top:20px;">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placeimg.com/80/80" alt="...">
        </a>
      </div>
      <div class="media-body" style="margin-left: 10px;">
        <h4 class="media-heading">Mohammed Talaat said...</h4>
        <p>
         this is a comment body
        </p>
        <span style="color: #aaa;">on 23/11/2017 11:00 am</span>
      </div>
    </div>
  </div>
@endsection