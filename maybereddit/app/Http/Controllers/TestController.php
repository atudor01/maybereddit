<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {

        $post = Post::find(278);

        dd($post->voters);

    }
}
