<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests;
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
        //
    }


    public function create()
    {

        return view('posts.create');

    }


    public function store(Post $post)
    {
        $post->create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id(),
            'slug' => str_slug(request('title')),
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
