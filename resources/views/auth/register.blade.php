<x-layout href="{{ mix('css/auth.css') }}">
    <fieldset>
        <legend>Register</legend>
        <h2>Register for an Account</h2>

        <form class="auth-form" action="{{ route('register') }}" method="POST">
            @csrf      
            <label for="name">Name:</label><br>
            <input type="text" name="name" required value="{{ old('name') }}"><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" required value="{{ old('email') }}"><br>
        
            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br>

            <label for="password_confirmation">Confirm Password:</label><br>
            <input type="password" name="password_confirmation" required><br>
        
            <button type="submit" class="btn mt-4">Register</button>
        
            <!-- validation errors -->
            
        </form>

        @if ($errors->any())
            <ul class="auth-errors">
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <p>Already have an account? <a href="/login">Log in</a> now!</p>
    </fieldset>
</x-layout>