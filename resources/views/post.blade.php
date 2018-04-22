@extends('layouts.master')

    <!-- Page Header -->
    
    {{-- <header class="masthead" style="background-image: url('/img/post-bg.jpg')"> --}}
    <header class="masthead" style="background-image: url('{{$post->photo ? '/photos/shares/' . $post->photo->file : '/img/post-bg.jpg'}}')">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1>{{ $post->title }}</h1>
              <h2 class="subheading">{{ $post->subheading}}</h2>
              <span class="meta">Posted by
                <a href="#"> {{ $post->user->name }} </a>
                on {{ $post->created_at->toFormattedDateString() }} 
                  @if($post->category)
                    under <a href="">{{$post->category->name}}</a></span>
                  @endif
            </div>
          </div>
        </div>
      </div>
    </header>
@include('includes.messages')
    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            @if($post->tags->isNotEmpty())
                Tags: 
                @foreach($post->tags as $tag)
                  <span class="label label-default">
                    {{$tag->name}}
                  </span>
                @endforeach
              {{-- </p> --}}
            @endif
            {!! $post->body !!}
            <hr>
              <!-- Blog Comments -->
              <!-- Comments Form -->
              @auth
                <div class="well">
                  <h4>Leave a Comment:</h4>
                  {!! Form::open(['method'=>'POST', 'action'=>'AdminCommentsController@store', 'files'=>true]) !!}
                  <input type="hidden" name="post_id" value="{{$post->id}}">
                  <div class="form-group">
                    {!! Form::label('body', 'Content:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 2]) !!}
                  </div>  
                  <div class="form-group">
                    {!! Form::submit('Comment', ['class'=>'btn btn-primary']) !!}
                  </div>
                  {!! Form::close() !!}
                </div> <!-- .well -->
              @endauth
                <hr>
                <!-- Posted Comments -->
                <!-- Comment -->
                @if($post->comments->isNotEmpty())
                  @foreach($post->comments as $comment)
                  <div class="media">
                    <div class="media-body">
                      <h4 class="media-heading">{{$comment->user->name}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                      </h4>
                      {{$comment->body}}
                      {!! Form::open(['method'=>'POST', 'action'=>'AdminRepliesController@store', 'files'=>true]) !!}
                      <input type="hidden" name="comment_id" value="{{$comment->id}}">
                      <div class="form-group">
                        {!! Form::label('body', 'Content:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 2]) !!}
                      </div>  
                      <div class="form-group">
                        {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                      </div>
                      {!! Form::close() !!}
                        {{-- Reply --}}
                        @if($comment->replies->isNotEmpty())
                          @foreach($comment->replies as $reply)
                          <div class="media ml-5">
                            <div class="media-body">
                              <h4 class="media-heading">{{$reply->user->name}}
                                <small>{{$reply->created_at->diffForHumans()}}</small>
                              </h4>
                              {{$reply->body}}
                              {!! Form::open(['method'=>'POST', 'action'=>'AdminRepliesController@store', 'files'=>true]) !!}
                              <input type="hidden" name="comment_id" value="{{$comment->id}}">
                              <div class="form-group">
                                {!! Form::label('body', 'Content:') !!}
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 2]) !!}
                              </div>  
                              <div class="form-group">
                                {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                              </div>
                              {!! Form::close() !!}
                            </div> {{-- Reply .media-body --}}
                          </div> {{-- Reply .media --}}
                          @endforeach
                        @endif
                    </div> {{-- Comment .media-body --}}
                  </div> {{-- Comment .media --}}
                  @endforeach
                @endif
                <!-- Comment -->
                <div class="media">
{{--                     <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a> --}}
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
{{--                             <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a> --}}
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>
                {{-- end of comments --}}

          </div>
        </div>
      </div>
    </article>

    <hr>
    <script>
      
    </script>