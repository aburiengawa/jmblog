<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex mr-auto" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>             
            </ul>
        @if (Route::has('login'))
            <ul class="navbar-nav float-right">
            @auth
                @if (Auth::user()->role_id !== 3)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin') }}">Admin</a>
                    </li>
                @else  
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin') }}">Welcome {{ Auth::user()->name }}</a>
                    </li>       
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>   
                @endif                   
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>  
                <li class="nav-item">                        
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endauth
            </ul>
        @endif
        </div> {{-- .navbar-collapse --}}
    </div> {{-- .container --}}
</nav>