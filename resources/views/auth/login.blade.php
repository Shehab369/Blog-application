@extends('layouts.app')
@section('content')
<h2>Login to your account</h2>
</h2>
<form action="{{ route('login.submit') }}" method="post">
    @csrf
    <div>
        <label>Email</label></label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
        @error('password') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <button type="submit" style="margin-top: 20px"; class="btn btn-secondary">login</button></button>
</form>
@endsection