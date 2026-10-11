@extends('layouts.app')
@section('content')
<h2>Create account</h2>
<form action="{{ route('register.submit') }}" method="post">
    @csrf
    <div>
        <label>Name</label></label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Email</label></label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Birthdate</label><br>
        <input type="date" name="birthdate" value="{{ old('birthdate') }}" required>
        @error('birthdate') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
        @error('password') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Confirm Password</label><br>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary" >Register</button>
</form>
@endsection