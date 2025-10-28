<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user:id,name')->latest()->get();
        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }
    public function create()
    {
        $this->authorize('create', Post::class);
        return Inertia::render('Posts/Create');
    }
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);
        $data['user_id'] = auth()->id();
        Post::create($data);
        return to_route('posts.index');
    }
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);
        $post->update($data);
        return to_route('posts.index');
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return to_route('posts.index');
    }
}
