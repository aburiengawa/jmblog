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
            @endif
            {!! $post->body !!}
            <hr>
            <!-- Blog Comments -->
            <!-- Comments Form -->
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
            <!-- Comments -->
            @if($post->comments->isNotEmpty())
            <button class="btn btn-link collapsed show-comment-button" data-toggle="collapse" data-target="#comments-replies-container"><span class="show-hide-comments-span show-comments"></span><i class="icon-arrow fa fa-angle-right"></i></button>
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
                        <div class="comment-body">{{$comment->body}}</div>
                        {!! Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store']) !!}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <input type="hidden" name="username" value="{{Auth::user()->name}}">
                            <div class="form-group hide-element">
                            {!! Form::textarea('body', null, ['class'=>'reply-textarea form-control', 'rows' => 2, 'required']) !!}
                            </div>  
                                <div class="form-group reply-link">
                                    <a href="#void"><small>REPLY</small></a>
                                </div>
                            <div class="form-group reply-elements hide-element">
                                {!! Form::submit('Post Reply', ['class'=>'send-reply-to-comment btn btn-primary']) !!}
                                <span class="reply-hide"><a href="#void"><small>HIDE</small></a></span>
                                <span class="delete-comment"><a href="#void"><small>DELETE</small></a></span>
                            </div>
                        {!! Form::close() !!}
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
                                    <div class="comment-body">{{$reply->body}}</div>
                                    {!! Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store']) !!}
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <input type="hidden" name="username" value="{{Auth::user()->name}}">      
                                        <div class="form-group hide-element">
                                            {!! Form::textarea('body', null, ['class'=>'reply-textarea form-control', 'rows' => 2, 'required']) !!}
                                        </div>  
                                        <div class="form-group reply-link">
                                            <a href="#void"><small>REPLY</small></a>
                                        </div>
                                        <div class="form-group hide-element">
                                            {!! Form::submit('Post Reply', ['class'=>'send-reply-to-reply btn btn-primary']) !!}
                                            <span class="reply-hide"><a href="#void"><small>HIDE</small></a></span>
                                            <span class="delete-reply"><a href="#void"><small>DELETE</small></a></span>
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
            </div> {{-- #comments-replies-container --}}
            </div> {{-- #ajax-comment-container --}}
            {{-- end of comments --}}
            </div> {{-- .col-lg-8 col-md-10 mx-auto --}}
        </div> {{-- .row --}}
    </div> {{-- .container --}}
</article>
<hr>
@include('includes.comments-ajax')
@include('includes.delete-comment-reply-swal')
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/reply-hide.js')}}"></script>
<script>
    $('.show-comment-button').on('click', function(){
        $('.show-hide-comments-span').toggleClass('show-comments');
        $('.show-hide-comments-span').toggleClass('hide-comments');        
        $('.icon-arrow').toggleClass('fa-angle-right');
        $('.icon-arrow').toggleClass('fa-angle-down');
    });
</script>
@endsection