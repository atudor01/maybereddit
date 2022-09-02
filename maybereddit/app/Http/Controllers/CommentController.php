<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->comment_body;
        $comment->user_id = auth()->user()->id;
        $post = Post::find($request->post_id);
        $post->comments()->save($comment);
        return back();
    }


    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->comment_body;
        $reply->user_id = auth()->user()->id;
        $reply->parent_id = $request->comment_id;
        $post = Post::find($request->post_id);
        $post->comments()->save($reply);

        return back();

    }

}
