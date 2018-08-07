@extends('layouts.master')
@section('content')
<header class="masthead" style="background-image:url('{{'/img/ai-close-up-code-160107-edited.jpg'}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>What's this all about?</h1>
                    <h2 class="subheading">My personal blog about web dev & other things</h2>
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
            <p>August 2018</p>
			<p>It took me a <em>very</em> long time to put this up here. Doing <a href="https://www.freecodecamp.org/" target="_blank">freeCodeCamp</a>, taking in a 6-day work week schedule, working on my <a href="https://udemy.com/essential-japanese-travel-phrases" target="_blank">Udemy Japanese course</a>, and this... Just checked github, my first commit was 10 months ago!</p>
            <p>So, what's this blog for?</p>
            <p>1. My first Laravel project that I can show people.</p>
            <p>2. An exercise of putting everything I've learned together</p>
            <p>3. An exercise in taking someone else's front end template, and customizing it to make it work for me. (And in this template's case, fixing it because some parts were broken.)</p>
            <p>4. It's going to be part of my portfolio.</p>
            <p>5. A place where I can improve my skills by continuing to add more and more functions to the site.</p>
            <p>6. My personal blog for web stuff and other things.</p>
            <p>So, who am I? Well, I'm just another (gaijin) guy living in Tokyo who's been here since 2011, and I'm still trying to make my way in life. Yeah, I know. I'm a late bloomer.</p>
            <p>I've been, as they say, "<a href="https://www.japantimes.co.jp/community/2014/01/22/general/teachers-tread-water-in-eikaiwa-limbo/" target="_blank">stuck in eikaiwa limbo</a>", mainly because I didn't really know what I wanted to do, but finally since early last year, I figured it out. A good friend of mine, a developer in the US, suggested that I might like web develpment, so I got <s>a few</s> tons of courses from Udemy and was hooked! Problem is, I was hooked to the point that I ended up in "<a href="https://medium.freecodecamp.org/how-to-escape-tutorial-purgatory-as-a-new-developer-or-at-any-time-in-your-career-e3a4b2384a40">tutorial purgatory</a>". Fortunately though, I think (<em>think</em> is the keyword here) I've finally clmibed out of that purgatory and have been doing my own stuff.</p>
            <p>Thank you to all developers out there for having already gotten into the same problems as I have, because if you hadn't, then I might have not found a solution to 90% of the issues I ran into. <a href="https://stackoverflow.com/" target="_blank">Stackoverflow</a> really is greatest gift to programming.</p>
            <p>The blog is still pretty bare right now, but in the coming months(ish) I plan to add other features such as social media and newsletters. Yeah, I know, no one is going to be reading this anyway, but I want to add all those things as a way for me to grow as a web developer.</p>
            <p>If you're interested, the code for this site is <a href="https://github.com/agedengaku/jmblog" target="_blank">here</a>.</p>
            <p>Thanks for dropping by! I hope you find something here that you like.</p>
            <p><strong>PS.</strong> I love sushi. That's why I called this blog "Sushi Dev". My favorite sushi is <em><a href="https://uds.gnst.jp/rest/img/et6ynbn50000/s_00a2.jpg?t=1495877329">aburi engawa (炙りえんがわ)</a></em>. Many sushi restaurants don't have this on the menu, but if you ask for it, they'll make it for you. You really have to try it!</p>
            <hr>
            {{-- end of comments --}}
            </div> {{-- .col-lg-8 col-md-10 mx-auto --}}
        </div> {{-- .row --}}
    </div> {{-- .container --}}
</article>
<hr>
@endsection