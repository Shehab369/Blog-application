@extends('layouts.app')
@section('content')
<h2>User's Dashboard</h2>
<p>Hello {{ $user?->name }}!</p>
<p>Email: {{ $user?->email }} </p>
<p> Birthday: {{ $user?->birthdate }}</p>
@endsection