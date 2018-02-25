<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show',]);
    }
    
    public function index()
    {
        $posts = Post::latest()->get();
        
        return view('posts.index', compact('posts') );
    }
    
    public function show(Post $post)
    {
        // TODO: Sanitize user input
        // TODO: Strengthen the validation
        return view('posts.show', compact('post') );
    }
    
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store()
    {
        // TODO: Sanitize user input
        // TODO: Strengthen the validation

        $this->validate(request(),[
            'title' => 'required|max:200',
            
            'body' => 'required|max:1000'
            
        ]);
        
        //TODO: Sanitation, Validation
        auth()->user()->publish(
            new Post( request(['title', 'body']) )
        );
        
        return redirect('/');
        
    }
}
