<?php

namespace App\Http\Controllers;

use App\Events\CommentEvent;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Licitation;

class CommentsController extends Controller
{
    public function store(Request $request, string $id) {
        $licitation = Licitation::findOrFail($id);

        $validatedData = $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->licitation_id = $id;
        $comment->comment = $validatedData['comment'];
        $comment->save();

        $receiver_id = $licitation->user_id;
        $name = $licitation->manufacturer . " " . $licitation->model . " (" . $licitation->year . ")";
        event(new CommentEvent($receiver_id, $name));

        session()->flash('message', 'Comment was added.');
        return redirect('/licitation_details/' . $id);
    }

    public function destroy(string $id, string $licitation_id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect('/licitation_details/' . $licitation_id)->with('message', 'Comment was deleted.');
    }
}
