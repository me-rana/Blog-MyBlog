@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
@endphp
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark menu">
    <div class="container">
        <a class="navbar-brand navmenu" href="#!">MyBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="/about">About</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="/contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('singlepost') ? 'active' : '' }}" href="#">Single Post</a></li>

                @if (Auth::user() == null)
                <li class="nav-item"><a class="nav-link" href="../register">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="../login">Login</a></li>
                @else
                <li class="nav-item"><a class="nav-link" href="../access">My Account</a></li>
                <li class="nav-item"><form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf <input class="btn" style="background-color:transparent;color:rgba(226, 225, 225, 0.555);color:hover:white;" type="submit" value="Logout"></form></li>

                @endif

            </ul>
        </div>
    </div>
</nav>
