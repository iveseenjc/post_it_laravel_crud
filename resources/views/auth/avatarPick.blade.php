<x-layout href="{{ mix('css/avatarPick.css') }}">
    <fieldset>
        <h2>Pick an avatar</h2>
        <form action="{{ route('store.avatar') }}" method="POST">
            @csrf
            @foreach ($avatars as $avatar)
                <label>
                    <input type="radio" name="avatar" value="{{ $avatar }}" required>
                    <img src="{{ asset('images/avatars/' . $avatar) }}" alt="avatar">
                </label>
            @endforeach
            <button type="submit">Confirm</button>
        </form>
    </fieldset>    
</x-layout>           