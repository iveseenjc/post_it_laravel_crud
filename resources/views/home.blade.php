<x-layout href="{{ mix('css/posts.css') }}">
    <h1>This is the posts page!</h1>
    
    <fieldset>
        <img class="profile-picture" src="{{ asset(Auth::user()->avatar_source) }}" alt="">
        <form action="{{ route('store.home') }}" method="POST">
            @csrf
            <textarea 
                name="body" cols="50" rows="4" maxlength="200" placeholder="What's on your mind?" required
                value="{{ old('body') }}" style="resize: none"></textarea>
                <br>
            <button type="submit">Post</button>
        </form>
    </fieldset>
    <ul class="recent-posts">
        <h2>Recent Posts</h2>
        @foreach ($posts as $post)
            <li class="post">
                <span>
                    <img class="profile-picture" src="{{ asset($post->user->avatar_source) }}" alt="">
                    <b class="user-name">{{ $post->user->name }}</b>
                </span>

                @if ($post->user_id === auth()->id())
                    <span class="modify-buttons">
                        <a href="{{ route('edit.home',  $post->id) }}">
                            <button class="edit-button"><i class="fa fa-pencil"></i></button>
                        </a>
                        <form class="delete-form" action="{{ route('destroy.home', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete-button" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                    </span>
                @endif

                <p class="post-body">{{ $post->body }}</p>
                <small>Posted at: {{  $post->created_at->diffForHumans() }}</small>
                @if ($post->created_at != $post->updated_at)
                    <small>Edited at: {{ $post->updated_at->format('M d, Y h:i A') }}</small>
                @endif
            </li>
        @endforeach
    </ul>
</x-layout>