@extends('layouts.master')
@section('content')
    <!-- Page Header -->
    @include('includes.message-modal')
    @if(session()->has('error'))
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>$(document).ready(function(){
            $('#myModal').modal('show'); 
        });</script>
    @endif
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Clean Blog</h1>
              <span class="subheading">A Blog Theme by Start Bootstrap</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          @foreach($posts as $post)
          <div class="post-preview">
            <a href="post/{{ $post->id }}">
              <h2 class="post-title">{{ $post->title}}</h2>
              <h3 class="post-subtitle">{!! str_limit($post->body, 100) !!}</h3>
            </a>
            <p class="post-meta">Posted by <a href="#">{{ $post->user->name }}</a> on {{ $post->created_at->toFormattedDateString() }}</p>
            @if($post->tags->isNotEmpty())
                @foreach($post->tags as $tag)
                    <span class="label label-default tag-link">
                        <a href="{{ url('/') }}/tag/{{ $tag->id }}">{{$tag->name}}</a>
                    </span>
                @endforeach
            @endif
          </div> 
          <hr>
          @endforeach
          <!-- Pager -->
          <div class="clearfix">
            @if($posts->previousPageUrl())
            <a class="btn btn-secondary float-left" href="{{ $posts->previousPageUrl() }}">&larr; Newer Posts</a>
            @endif
            @if($posts->nextPageUrl())
            <a class="btn btn-secondary float-right" href="{{ $posts->nextPageUrl() }}">Older Posts &rarr;</a>
            @endif
          </div>
        </div>
      </div>
    </div>

    <hr>
@endsection