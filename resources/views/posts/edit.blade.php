@extends('layouts.app')
@section('content')
<h2>Edit Post</h2>
<form action="{{ route('posts.update', $post) }}" method="post">
    @csrf
    @method('PUT')
    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        @error('title') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Content</label><br>
        <textarea name="content">{{ old('content', $post->content) }}</textarea>
        @error('content') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>

</form>
@endsection