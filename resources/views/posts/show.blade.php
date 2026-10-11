@extends('layouts.app')
@section('content')
<h2>{{ $post->title }}</h2>
<article>{{ $post->content }}</article>
<a style="margin-top: 30px;" href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
@endsection