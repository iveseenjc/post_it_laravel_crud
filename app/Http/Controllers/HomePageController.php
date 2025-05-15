<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller {
    public function index() {
        $posts = Post::with('user')->latest()->get();
        return view('home', compact('posts'));
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
    
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        return view('editPost', compact('post'));
    }
    
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
    
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        $request->validate([
            'body' => 'required|string|max:200',
        ]);
    
        $post->body = $request->input('body');
        $post->save();
    
        return redirect()->route('index.home')->with('success', 'Post updated.');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);

        if ($post->user_id !==  Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();
        
        return redirect()->route('index.home')->with('success', 'Post deleted.');
    }

    public function store(Request $request) {
        $request->validate([
            'body' => 'required|max:280'
        ]);
    
        $user = Auth::user();
        $user->posts()->create([
            'body' => $request->body
        ]);
    
        return redirect()->route('index.home');
    }
}
