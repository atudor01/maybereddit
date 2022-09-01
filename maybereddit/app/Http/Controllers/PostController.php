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

        // get latest posts
        $posts = Post::latest()->paginate();

        // No need for this because you can use Str::limit() in the view
        //for loop to manipulate each post body should limit with 100 characters
//        foreach ($posts as $post) {
//            if (strlen($post->body) > 100) {
//                $post->body = substr($post->body, 0, 100) . '...';
//            }
//        }

        return view('index', compact('posts'));

    }


    public function create()
    {

        return view('posts.create');

    }

    public function admin()
    {
        $posts = Post::latest()->paginate();
        return view('admin.posts', compact('posts'));
    }
    public function admin2()
    {
        $posts = Post::all();
        return view('admin.posts2', compact('posts'));
    }
    public function admin3()
    {
        $posts = Post::all();
        return view('admin.posts3', compact('posts'));
    }
    public function something(Request $request)
    {

        $post = Post::find($request->data[0]);
        $user = $post->user;
        if($request->change[0][1]==1){
            $post->title = $request->change[0][3];

        }
        if($request->change[0][1]==2){
            $post->user->name = $request->change[0][3];
            $user->save();
        }

        $post->save();


        return redirect()->route('admin.posts3');
    }

    public function store(Request $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
            //'slug' => str_slug($request->title),
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

    public function myposts()
    {
        $user = auth()->user();

        //check user log in
        if (!$user) {
            return redirect('/');
        }

        $posts = $user->posts()->latest()->paginate();
        return view('posts.myposts', compact('posts'));
    }

    //create  a function that upvotes post
    public function upvote(Post $post)
    {
        $user = auth()->user();
        $user->upvote($post);

        return back();
    }

    //create  a function that downvotes post
    public function downvote(Post $post)
    {
        $user = auth()->user();
        $user->downvote($post);

        return back();
    }



}
