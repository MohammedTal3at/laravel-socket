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
      <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
      <button @click.prevent="addComment" :disabled="!commentBox" class="btn btn-success" style="margin-top:10px" >Save Comment</button>
    </div>
    <div class="media" style="margin-top:20px;" v-for="comment in comments">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placeimg.com/80/80" alt="...">
        </a>
      </div>
      <div class="media-body" style="margin-left: 10px;">
        <h4 class="media-heading">@{{ comment.user.name }} said...</h4>
        <p>
         @{{ comment.body }}
        </p>
        <span style="color: #aaa;">on @{{ comment.created_at }}</span>
      </div>
    </div>
  </div>

@endsection
@section('script')
  {{-- expr --}}
  <script>
    //define vue instance
    const api_url = "http://localhost/laravel-socket/api/";
    const app = new Vue({
      el : '#app',
      data : {
        comments : {},
        commentBox : '',
        post : {!! $post->toJson() !!},
        user : {!! Auth::check()? Auth::user() : 'null' !!}
      },
      mounted(){
        this.getComments();  //load comments for this post
      },
      methods : {
        getComments : function(){
          axios.get(`${api_url}posts/${this.post.id}/comments`).then((res)=>{
            this.comments = res.data.data;
          }).catch(err=>{
            console.log(err);
          })
        },

        addComment : function(){
           axios.post(`${api_url}posts/${this.post.id}/comment` , {body:this.commentBox , api_token:this.user.api_token}).then((res)=>{
            this.comments.unshift(res.data.data);
            this.commentBox = ''; 
          }).catch(err=>{
            console.log(err);
          })
        }
      }
    });
    
  </script>
@endsection