@extends('layouts.app')
@section('content')
<h2>New Post</h2>
<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required>
        @error('title') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Content</label><br>
        <textarea name="content">{{ old('content') }}</textarea>
        @error('content') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>

</form>
@endsection