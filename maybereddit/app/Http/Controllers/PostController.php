<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->latest()->paginate();

        //for loop to manipulate each post body should limit with 100 characters
        foreach ($posts as $post) {
            if (strlen($post->body) > 100) {
                $post->body = substr($post->body, 0, 100) . '...';
            }
        }

        return view('index', compact('posts'));

    }


    public function create()
    {

        return view('posts.create');

    }


    public function store(Request $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'slug' => str_slug($request->title),
        ]);

        return redirect()->route('posts.show', $post);
    }

//        $attributes = request()->validate([
//            'title' => 'required',
//            'body' => 'required',
//        ]);
//        $attributes['user_id'] = auth()->id();
//        $attributes['slug'] = str_slug($attributes['title']);
//        Post::create($attributes);
//
//        return redirect('/');//->route('posts.show')->with('success', 'Post added successfully');
//    }


    public function show(Post $post)
    {

        $user = auth()->user();
//        if ($user->hasRole('admin')){
//            dd('yersss');
//        }else{
//            dd('no');
//        }




        return view('posts.show', compact('post', 'user'));
    }


    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }


    public function update(Post $post)
    {
        $post->update([
            'title' => request('title'),
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


}
