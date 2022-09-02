<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate();
        return view('index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    public function getLivewire()
    {
        $posts = Post::latest()->paginate();
        return view('admin.livewiretable', compact('posts'));
    }

    public function getHandsOnTable()
    {
        $posts = Post::latest()->paginate();
        return view('admin.handsontable', compact('posts'));
    }


    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        $user = auth()->user();
        return view('posts.show', compact('post', 'user', ));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Post $post, $request)
    {
        $post->update([
            'title' => $request->title,
            'body' => request('body'),
            'slug' => str_slug(request('title')),
        ]);
        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

    public function seeMyPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->paginate();
        return view('posts.myposts', compact('posts'));
    }

    public function upvote(Post $post)
    {
        $user = auth()->user();
        $user->upvote($post);
        return back();
    }

    public function downvote(Post $post)
    {
        $user = auth()->user();
        $user->downvote($post);
        return back();
    }

    public function updateViaAjax(Request $request)
    {
      $oldData =$request->change[0];
      $newData =$request->data;
      if ($oldData[1]== '1'){
          //update title

          $post = Post::where('id',$newData[0]);
          $post->update([
              'title' => $oldData[3],
              'slug' => str_slug($oldData[3])
          ]);
          return redirect()->route('admin.posts2');
      }

      if ($oldData[1]== '4'){
            $user = User::where('id', $newData[3]);
            $user->update([
              'name' => $oldData[3],
          ]);
      }

      return response()->json([
          'status' => 'success'
      ]);

    }

}
