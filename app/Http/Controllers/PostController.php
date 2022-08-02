<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show()
    {
        return view('post.testpost');
    }

    // public function string()
    // {
    //     return "Hello World";
    // }

    // function create(){
    //     return view('form.create');
    // }
}
