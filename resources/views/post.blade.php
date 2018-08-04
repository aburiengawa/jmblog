@extends('layouts.master')
@section('content')
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
                    under <a href="{{ url('/') }}/category/{{ $post->category->id }}">{{$post->category->name}}</a></span>
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
                <span class="tag-style">Tags: </span>
                @foreach($post->tags as $tag)
                    <span class="label label-default tag-link">
                        <a href="{{ url('/') }}/tag/{{ $tag->id }}">{{$tag->name}}</a>
                    </span>
                @endforeach
            @endif
            {!! $post->body !!}
            <hr>
            <!-- Blog Comments -->
            <!-- Comment Form -->
            @auth
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    {!! Form::open(['method'=>'POST', 'id'=>'comment-form', 'action'=>'AdminCommentsController@store']) !!}
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <input type="hidden" name="username" value="{{Auth::user()->name}}">
                        <div class="form-group">
                            {!! Form::label('body', 'Content:') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'id'=>'comment-textarea', 'rows' => 2, 'required']) !!}
                        </div>  
                        <div class="form-group">
                            {!! Form::submit('Post Comment', ['class'=>'send-comment btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div> <!-- .well -->
            @endauth
            <hr>
            <!-- Comment Form End-->
            <!-- Comments Section -->
            @if(!Auth::check())
            <div>You must <a href="{{URL::to('/login')}}">sign in</a> to post comments</div>
            @endif
            @if($post->comments->isNotEmpty())
            <button id="show-hide-comments-button"  class="btn btn-link collapsed" data-toggle="collapse" data-target="#comments-replies-container"><span class="show-hide-comments-span show-content">Show Comments</span><span class="show-hide-comments-span hide-content">Hide Comments</span><i class="icon-arrow-show fa fa-angle-right"></i><i class="icon-arrow-hide fa fa-angle-down"></i></button>
            @endif 
            <div id="ajax-comment-container">
            <div id="comments-replies-container" class="collapse">
            @if($post->comments->isNotEmpty())
                @foreach($post->comments->reverse() as $comment)
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->user->name}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        <input class="comment-id" type="hidden" name="id" value="{{$comment->id}}">
                        {{-- <div class="comment-body">{{$comment->body}}</div> --}}
                        <div class="comment-body">{!! $comment->body !!}</div>
                        @auth
                        {!! Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store']) !!}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <input type="hidden" name="username" value="{{Auth::user()->name}}">
                            <div class="form-group hide-element">
                            {!! Form::textarea('body', null, ['class'=>'reply-textarea form-control', 'rows' => 2, 'required']) !!}
                            </div>  
                                <div class="form-group reply-link">
                                    <a href="#void"><small>REPLY | OPTIONS</small></a>
                                </div>
                            <div class="form-group reply-elements hide-element">
                                {!! Form::submit('Post Reply', ['class'=>'send-reply-to-comment btn btn-primary']) !!}
                                <span class="reply-hide"><a href="#void"><small>HIDE</small></a></span>
                                @if(Auth::user()->role_id === 1 || Auth::user()->id === $comment->user->id)
                                <span class="delete-comment"><a href="#void"><small>DELETE</small></a></span>
                                @endif
                            </div>
                        {!! Form::close() !!}
                        @endauth
                        {{-- Reply --}}
                        @if($comment->replies->isNotEmpty())
                            @foreach($comment->replies->reverse() as $reply)
                            <div class="media ml-5">
                                <input class="comment-id-delete" type="hidden" value="{{$comment->id}}">
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->user->name}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <input class="reply-id" type="hidden" name="id" value="{{$reply->id}}">
                                    <div class="comment-body">{!! $reply->body !!}</div>
                                    @auth
                                    {!! Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store']) !!}
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <input type="hidden" name="username" value="{{Auth::user()->name}}">      
                                        <div class="form-group hide-element">
                                            {!! Form::textarea('body', null, ['class'=>'reply-textarea form-control', 'rows' => 2, 'required']) !!}
                                        </div>  
                                        <div class="form-group reply-link">
                                            <a href="#void"><small>REPLY | OPTIONS</small></a>
                                        </div>
                                        <div class="form-group hide-element">
                                            {!! Form::submit('Post Reply', ['class'=>'send-reply-to-reply btn btn-primary']) !!}
                                            <span class="reply-hide"><a href="#void"><small>HIDE</small></a></span>
                                            @if(Auth::user()->role_id === 1 || Auth::user()->id === $reply->user->id)
                                            <span class="delete-reply"><a href="#void"><small>DELETE</small></a></span>
                                            {{-- <span class="edit-reply"><a href="#void"><small>EDIT</small></a></span> --}}
                                            @endif
                                        </div>
                                    {!! Form::close() !!}
                                    @endauth
                                </div> {{-- Reply .media-body --}}
                            </div> {{-- Reply .media --}}
                            @endforeach
                        @endif
                    </div> {{-- Comment .media-body --}}
                </div> {{-- Comment .media --}}
                @endforeach
            @endif
            </div> {{-- #comments-replies-container --}}
            </div> {{-- #ajax-comment-container --}}
            {{-- end of comments --}}
            </div> {{-- .col-lg-8 col-md-10 mx-auto --}}
        </div> {{-- .row --}}
    </div> {{-- .container --}}
</article>
<hr>
@auth
@include('includes.comments-ajax')
@include('includes.delete-comment-reply-swal')
<script src="{{asset('js/reply-hide.js')}}"></script>
@endauth
<script src="{{asset('js/sweetalert.min.js')}}"></script>
@endsection