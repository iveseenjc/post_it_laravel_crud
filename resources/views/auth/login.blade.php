<x-layout href="{{ mix('css/auth.css') }}">
    <fieldset>
        <legend>Login</legend>
        <h2>Log In to Your Account</h2>

        <form class="auth-form" action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email:</label><br>
            <input type="email" name="email" required value="{{ old('email') }}"><br>
        
            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br>
        
            <button type="submit" class="btn mt-4">Log in</button>            
        </form>
        <!-- validation errors -->
        @if ($errors->any())
            <ul class="auth-errors">
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>           
        @endif  
        <p>Don't have an account? <a href="/register">Register</a> now!</p>
    </fieldset>
</x-layout>