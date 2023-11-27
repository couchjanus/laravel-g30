<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = \DB::table('posts')->get();
        $posts = \DB::table('posts')->paginate(7);
        return view('blog.index', ['posts'=>$posts]);
    }

    public function show(int $id)
    {
        // $posts = \DB::table('posts')->where('id', $id)->get();
        $post = \DB::table('posts')->find($id);
        return view('blog.show', ['post'=>$post]);
    }
}
