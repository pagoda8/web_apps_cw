<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, string $id) {
        $validatedData = $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->licitation_id = $id;
        $comment->comment = $validatedData['comment'];
        $comment->save();

        session()->flash('message', 'Comment was added.');
        return redirect('/licitation_details/' . $id);
    }

    public function destroy(string $id, string $licitation_id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect('/licitation_details/' . $licitation_id)->with('message', 'Comment was deleted.');
    }
}
