<x-layout href="{{ mix('css/editPost.css') }}">
    <fieldset>
        <legend>Login</legend>
        <h2>Editing your post</h2>

        <form action="{{ route('update.home', $post->id) }}" method="POST" onsubmit="return confirmUpdate()">
            @csrf
            @method('PUT')
            <textarea 
                name="body" cols="50" rows="4" maxlength="200" placeholder="Edit your post" required
                style="resize: none">{{ $post->body }}</textarea>

            <span>
                <button class="confirm-edit" type="submit">Confirm Edit</button>
                <button class="cancel-edit" type="button" onclick="cancelEdit()">Cancel Edit</button>
            </span>
        </form>
        <!-- validation errors -->
        @if ($errors->any())
            <ul class="auth-errors">
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>           
        @endif  
    </fieldset>

    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to save changes to this post?");
        }
    
        function cancelEdit() {
            if (confirm("Are you sure you want to cancel editing? Changes will not be saved.")) {
                window.location.href = "{{ url('/posts') }}";
            }
        }
    </script>
</x-layout>