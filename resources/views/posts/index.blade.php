@extends('layouts.app')
@section('content')
<h2>All Posts</h2>
<p><a href="{{ route('posts.create') }}" class="btn btn-primary">+ Add new post</a></p>

@if($posts->isEmpty())
<p>No posts available yet</p>
@else
@foreach($posts as $post)
<div class="card">
    <h3>{{ $post->title }}</h3>
    <small>— {{ $post->created_at->diffForHumans() }} </small>
    <p>{{ Str::limit($post->content, 120) }}</p>
    <div>
        <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Show</a>
        @if(session('user_id') === $post->user_id)
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', $post) }}" method="post" style="display:inline" onsubmit="return confirm('Are you sure you want to delete the post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endif
    </div>
</div>
@endforeach
@endif
@endsection