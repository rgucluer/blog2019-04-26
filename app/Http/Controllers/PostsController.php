<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show',]);
    }
    
    public function index(Posts $posts)
    {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();
        
        return view('posts.index', compact('posts') );
    }
    
    public function show(Post $post)
    {
        return view('posts.show', compact('post') );
    }
    
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store()
    {
        // TODO: User input validation

        $this->validate(request(),[
            'title' => 'required|max:200',
            
            'body' => 'required|max:1000'
        ]);
        
        // TODO: User input validation
        auth()->user()->publish(
            new Post( request(['title', 'body']) )
        );
        
        session()->flash(
            'message', 'Your post has now been published'
        );

        return redirect('/');
        
    }
}
