<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Validar
        $this->validate($request, [
            'comment' => ['required', 'max:255']
        ]);
        // Almacenar el resultado
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment
        ]);

        // Imprimir un mensaje
        return back()->with('message', 'Comment created successfully');
    }
}
