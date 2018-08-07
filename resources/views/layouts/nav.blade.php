<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container navbar-container">
        <a class="navbar-brand d-flex mr-auto" href="{{ url('/') }}">Sush Dev</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive">
            {{-- <div class="ul-wrapper"> --}}
            <ul class="navbar-nav">
{{--                 <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://jmotaylor.com#contact-block">Contact</a>
                </li>        
            </ul>
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
                <li class="nav-item">                        
                    <a class="nav-link" href="{{ url('/categories') }}">Categories</a>
                </li>    
                <li class="nav-item">
                    <div class="sidebar-module input-group">
                        <form action="/search/" method="GET">
                            <input id="search-input" class="form-control" type="text" name="s" value="{{ Request::query('s') }}" placeholder="" />
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary search-button" type="submit" id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            {{-- </div> --}} {{-- ul-wrapper --}}
        </div> {{-- .navbar-collapse --}}
    </div> {{-- .container --}}
</nav>