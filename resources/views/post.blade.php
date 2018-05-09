@extends('layouts.master')
    <!-- Page Header -->
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    {!! Form::open(['method'=>'POST', 'id'=>'comment-form', 'action'=>'AdminCommentsController@store', 'files'=>true]) !!}
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
            <div class="comments-replies-container">
            {{-- <span id="post_id-holder">{{$post->post_id}}</span> --}}
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
                                <div class="form-group hide-element">
                                    {!! Form::label('body', 'Content:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 2]) !!}
                                </div>  
                                <div class="form-group reply-link">
                                    <a href="#void"><small>REPLY</small></a>
                                </div>
                                 <div class="form-group hide-element">
                                    {!! Form::submit('Post Reply', ['class'=>'btn btn-primary']) !!}
                                    <span class="reply-hide">
                                        <a href="#void"><small>HIDE</small></a>
                                    </span>
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
                                                <div class="form-group hide-element">
                                                    {!! Form::label('body', 'Content:') !!}
                                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 2]) !!}
                                                </div>  
                                                <div class="form-group reply-link">
                                                    <a href="#void"><small>REPLY</small></a>
                                                </div>
                                                <div class="form-group hide-element">
                                                    {!! Form::submit('Post Reply', ['class'=>'btn btn-primary']) !!}
                                                    <span class="reply-hide">
                                                        <a href="#void"><small>HIDE</small></a>
                                                    </span>
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
            </div> {{-- comments-replies-container --}}
            {{-- end of comments --}}
            </div> {{-- .col-lg-8 col-md-10 mx-auto --}}
        </div> {{-- .row --}}
    </div> {{-- .container --}}
</article>
<hr>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        $('.send-comment').click(function () {
            $('#comment-form').submit(function (e) {
                e.preventDefault();
                var token = $('input[name=_token]').val();
                var post_id = $('input[name=post_id]').val();
                var username = $('input[name=username]').val();
                var body = $('textarea[name=body]').val();
                $.ajax({
                    url: '../comments/create',
                    type: "POST",
                    data: {_token: token, post_id: post_id, body: body},
                    success: function (response) {
                        $("#comment-textarea").val('');   
                        $(".comments-replies-container").prepend('<div class="media"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4>'+body+'{!! Form::open(["method"=>"POST","action"=>"AdminRepliesController@store","files"=>true]) !!}<input type="hidden" name="comment_id" value='+response+'><div class="form-group hide-element">{!!Form::label("body","Content:") !!}{!! Form::textarea("body",null,["class"=>"form-control","rows"=>2])!!}</div><div class="form-group prepend-reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply",["class"=>"btn btn-primary"]) !!}<span class="prepend-reply-hide"><a href="#void"><small>HIDE</small></a></span></div>{!! Form::close() !!}</div></div>');
                        prependReplyHideLink();                                  
                    }
                });
            });
        });
        function getComments(id){
            $.ajax({
                url: '../getcomments',
                data: {id:id},
                success: function(data){
                    var contentBlock = '';
                    data.comments.forEach(function (element) {
                        contentBlock += '<h1>' + element.created_at + '</h1>';
                    });
                    $(".comments-replies-container").html(contentBlock);
                    console.log(data);
                }
            });
        }
    });
</script>
<script src="{{asset('js/reply-hide.js')}}"></script>