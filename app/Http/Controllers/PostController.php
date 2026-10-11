<?php

namespace App\Http\Controllers;



use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    
    public function create()
    {
        return view('posts.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content'  => ['nullable', 'string'],
        ]);

        $data['user_id'] = session('user_id');
        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'Post created succesfully !');
    }

    
    public function show(Post $post)
    {
        //if ($this->authorizeOwner($post)) {
            return view('posts.show', compact('post'));
        // } else {
        //     return redirect()->route('posts.index')->with('error', 'unauthorized access');
        // }
    }

    
    public function edit(Post $post)
    {
        if ($this->authorizeOwner($post)) {
            return view('posts.edit', compact('post'));
        } else {
            return redirect()->route('posts.index')->with('error', 'unauthorized access');
        }
    }
    
    public function update(Request $request, Post $post)
    {
        if ($this->authorizeOwner($post)) {

            $data = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'content'  => ['nullable', 'string'],
            ]);

            $post->update($data);
            return redirect()->route('posts.index')->with('success', 'Post updated :)');
        } else {
            return redirect()->route('posts.index')->with('error', 'unauthorized access');
        }
    }
    

    public function destroy(Post $post)
    {
        $this->authorizeOwner($post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted !');
    }

    
    private function authorizeOwner(Post $post)
    {
        return $post->user_id == session('user_id');
        
    }
}
