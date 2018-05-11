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
                @foreach($post->comments->reverse() as $comment)
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->user->name}}
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                            </h4>
                            {{$comment->body}}
                            {!! Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store', 'files'=>true]) !!}
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                <input type="hidden" name="username" value="{{Auth::user()->name}}">
                                <div class="form-group hide-element">
                                    {!! Form::label('body', 'Content:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'reply-textarea form-control', 'rows' => 2, 'required']) !!}
                                </div>  
                                <div class="form-group reply-link">
                                        <a href="#void"><small>REPLY</small></a>
                                </div>
                                <div class="form-group reply-elements hide-element">
                                    {!! Form::submit('Post Reply', ['class'=>'send-reply btn btn-primary']) !!}
                                    <span class="reply-hide">
                                        <a href="#void"><small>HIDE</small></a>
                                    </span>
                                </div>
                            {!! Form::close() !!}
                            {{-- Reply --}}
                            @if($comment->replies->isNotEmpty())
                                @foreach($comment->replies->reverse() as $reply)
                                    <div class="media ml-5">
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$reply->user->name}}
                                                <small>{{$reply->created_at->diffForHumans()}}</small>
                                            </h4>
                                            {{$reply->body}}
                                            {!! Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store', 'files'=>true]) !!}
                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                <input type="hidden" name="username" value="{{Auth::user()->name}}">      
                                                <div class="form-group hide-element">
                                                    {!! Form::label('body', 'Content:') !!}
                                                    {!! Form::textarea('body', null, ['class'=>'reply-textarea form-control', 'rows' => 2]) !!}
                                                </div>  
                                                <div class="form-group reply-link">
                                                    <a href="#void"><small>REPLY</small></a>
                                                </div>
                                                <div class="form-group hide-element">
                                                    {!! Form::submit('Post Reply', ['class'=>'send-reply btn btn-primary']) !!}
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
            //prevents multiple binding of click
            $('.send-comment').unbind("click");
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
                        // alert("Success");
                        $("#comment-textarea").val('');   
                        var newComment = $('<div class="media"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4>'+body+'{!! Form::open(["method"=>"POST","action"=>"AdminRepliesController@store","files"=>true]) !!}<input type="hidden" name="comment_id" value='+response+'><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!!Form::label("body","Content:") !!}{!! Form::textarea("body",null,["class"=>"form-control","rows"=>2])!!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply",["class"=>"btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span></div>{!! Form::close() !!}</div></div>');
                        $(".comments-replies-container").prepend(newComment);
                        // var replyAnchor = newComment.find('.reply-anchor');
                        // var hideAnchor = newComment.find('.hide-anchor');
                        // replyAnchor[0].addEventListener("click", function(){
                        //   this.previousElementSibling.classList.toggle("hide-element");
                        //   this.nextElementSibling.classList.toggle("hide-element");
                        //   this.classList.toggle("reply-link-hidden");
                        // });
                        // hideAnchor[0].addEventListener("click", function(){
                        //     this.parentElement.classList.toggle("hide-element");
                        //     this.parentElement.previousElementSibling.previousElementSibling.classList.toggle("hide-element");
                        //     this.parentElement.previousElementSibling.classList.toggle("reply-link-hidden");
                        // });                           
                    }
                });
            });
        });
        $('.send-reply').click(function () {
            //prevents multiple binding of click
            $('.send-reply').unbind("click");
            $('.reply-form').submit(function (e) {
                e.preventDefault();
                var $this = $(this);
                var token = $this.find('input[name=_token]').val();
                var comment_id = $this.find('input[name=comment_id]').val();
                console.log(comment_id);
                var username = $this.find('input[name=username]').val();
                var body = $this.find('textarea[name=body]').val();
                $.ajax({
                    url: '../replies/create',
                    type: "POST",
                    data: {_token: token, comment_id: comment_id, body: body},
                    success: function (response) {
                        $(".reply-textarea").val('');  
                        var newReply = $('<div class="media ml-5"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4>'+body+'{!!Form::open(['method'=>'POST', 'class'=>'reply-form', 'action'=>'AdminRepliesController@store','files'=>true])!!}<input type="hidden" name="comment_id" value='+comment_id+'><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::label('body','Content:') !!}{!! Form::textarea('body',null, ['class'=>'form-control','rows' => 2]) !!}</div><div class="form-group reply-anchor"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!!Form::submit('Post Reply',['class'=>'send-reply btn btn-primary'])!!}<span class="hide-anchor"><a href="#void"><small>HIDE</small></a></span></div>{!! Form::close() !!}</div></div>');
                        $this.parent().parent().after(newReply);
                        // var replyAnchor = newReply.find('.reply-anchor');
                        // var hideAnchor = newReply.find('.hide-anchor');
                        // replyAnchor[0].addEventListener("click", function(){
                        //   this.previousElementSibling.classList.toggle("hide-element");
                        //   this.nextElementSibling.classList.toggle("hide-element");
                        //   this.classList.toggle("reply-link-hidden");
                        // });
                        // hideAnchor[0].addEventListener("click", function(){
                        //     this.parentElement.classList.toggle("hide-element");
                        //     this.parentElement.previousElementSibling.previousElementSibling.classList.toggle("hide-element");
                        //     this.parentElement.previousElementSibling.classList.toggle("reply-link-hidden");
                        // });                        
                        // prependReplyHideLink();                                  
                    }
                });
                // console.log(data);
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