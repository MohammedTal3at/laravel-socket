@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>New Post</h1>
    <hr />
    <form method="post" action="{{ route('posts.store') }}">
      {{ csrf_field() }}
      <div class="form-group ">
        <label for="post_title">Title</label>
        <input  type="text" class="form-control {{ $errors->has('title')? 'is-invalid' : '' }}" id="post_title" name="title" placeholder="Title" value="{{ old('title') }}">
        {!! $errors->first('title', '<p class="text-danger">:message</p>') !!}
      </div>

      <div class="form-group ">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control {{ $errors->has('content')? 'is-invalid' : '' }}" rows="8" id="post_content" name="body" placeholder="Write something amazing..." value="{{ old('body') }}"></textarea>
        {!! $errors->first('body', '<p class="text-danger">:message</p>') !!}

      </div>


      <button type="submit" class="btn btn-primary btn-lg">Save Post</button>
    </form>

  </div>
@endsection
