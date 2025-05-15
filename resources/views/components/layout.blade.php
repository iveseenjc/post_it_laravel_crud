@props(['href' => mix('css/app.css'), 'title' => 'Post it'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ $href }}">
    <link rel="shortcut icon" href="images/post-it-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Post It</title>
</head>
<body>
    <header>
        <a href="/">
            <h1>
                <img src={{ asset('images/post-it-logo.png') }} alt="Post it logo" width="50px">
                {{ $title }}
            </h1>
        </a>
        <nav>
            <a href="/">Welcome Page</a>

            @guest
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endguest
            
            @auth  
                <a href="/posts">Posts</a>
                <span id="greeting-user" style="display: flex; align-items: center; gap: 0.5rem;">
                    <a class="avatar-pick" href="/pickAvatar">
                        @if (Auth::user()->avatar_source)
                            <img class="profile-picture" src="{{ asset(Auth::user()->avatar_source) }}" alt="User Avatar">
                        @else
                            Avatar
                        @endif
                    </a>
                    Hi there, {{ Auth::user()->name }}
                </span>
                <form class="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            @endauth
        </nav>
    </header>
    
    <main>
        {{ $slot }}
    </main>

    <footer>
        <p>&copy; 2025 - Post It LLC</p>
    </footer>
</body>
</html>