<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use App\User;

class AvatarPickController extends Controller
{
    public function showAvatarPick() {
        $files = File::files(public_path('images/avatars'));
        $avatars = collect($files)->map(function($file) {
            return $file->getFileName();
        });

        return view('auth.avatarPick', compact('avatars'));
    }

    public function store(Request $request) {
        $files = File::files(public_path('images/avatars'));
        $validAvatars = collect($files)
            ->map(function($file) {
                return $file->getFileName();
            })->toArray();
    
        $request->validate([
            'avatar' => ['required', Rule::in($validAvatars)]
        ]);
    
        $user = Auth::user();
        $user->avatar_source = 'images/avatars/' . $request->avatar;
        $user->save();
    
        // Redirect somewhere meaningful after setting avatar
        return redirect()->route('index.home')->with('success', 'Avatar selected!');
    }       
}
