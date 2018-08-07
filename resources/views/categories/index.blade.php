@extends('layouts.master')
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Categories</h1>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          
          @if($categories)
            @foreach($categories as $category)
            <div class="post-preview">
              {{-- <a href="{{url('/')}}/post/{{ $category->post->id }}"> --}}
                <h2 class="post-title">
                  <a href="{{ url('/') }}/category/{{ $category->id }}">{{ $category->name}}</a>
                </h2>
                <p class="post-meta"><i>Posts: </i><a href="{{ url('/') }}/category/{{ $category->id }}">{{ $category->posts->count() }}</a></p>
            </div> {{-- .post-preview --}}
            <hr>
            @endforeach
          <!-- Pager -->
            <div class="clearfix">
              {{-- {{ $posts->links() }} --}}
              @if($categories->previousPageUrl())
              <a class="btn btn-secondary float-left" href="{{ $categories->previousPageUrl() }}">&larr; Newer Posts</a>
              @endif
              @if($categories->nextPageUrl())
              <a class="btn btn-secondary float-right" href="{{ $categories->nextPageUrl() }}">Older Posts &rarr;</a>
              @endif
            </div> {{-- .clearfix --}}
          @endif
        </div> {{-- .col-lg-8.col-md-10.mx-auto --}}
      </div> {{-- .row --}}
    </div> {{-- .container --}}
    <hr>
@endsection