<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    public function index(User $user)
    {
        $posts  = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'image' => ['required']
        ]);

        Post::create([
            'title' => '',
            'text' => $request->title,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('post.index', auth()->user()->username)->with('success', 'Post ha sido creado.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Delte image
        $image_path = public_path('uploads/' . $post->image);

        if (File::exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('post.index', auth()->user()->username)->with('deleted', 'Post ha sido eliminado.');
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', ['post' => $post, 'user' => $user]);
    }
}
