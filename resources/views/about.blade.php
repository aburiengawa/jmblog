@extends('layouts.master')
@section('content')
<header class="masthead" style="background-image:">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>What's this all about?</h1>
                    <h2 class="subheading">My personal blog about web stuff and other things</h2>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
			<p>This is the body of the About page.</p>
            <hr>
            {{-- end of comments --}}
            </div> {{-- .col-lg-8 col-md-10 mx-auto --}}
        </div> {{-- .row --}}
    </div> {{-- .container --}}
</article>
<hr>
@endsection