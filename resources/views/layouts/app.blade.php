<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Application</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 12px;
            background: #f9f9fb;
            color: #333;
        }

        nav {
            background: #2d3748;
            padding: 0 12px;
            border-radius: 8px;
            margin-bottom: 20px 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 80px;
            height: 80px;
            
        }

        nav a,
        nav button {
            all: unset;
            display: flex;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            font-size: 20px;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background 0.2s;
            height: 40px;
            line-height: 40px;
          
        }

        nav a:hover,
        nav button:hover {
            background: #4a5568;
        }

        nav form {
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #2d3748;
            margin-bottom: 10px;
        }

        .card {
            background: #fff;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-top: 6px;
            font-size: 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #3182ce;
            color: #fff;
        }

        .btn-primary:hover {
            background: #2b6cb0;
        }

        .btn-danger {
            background: #e53e3e;
            color: #fff;
        }

        .btn-danger:hover {
            background: #c53030;
        }

        .btn-secondary {
            background: #718096;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #4a5568;
        }

        form div {
            margin-bottom: 12px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        textarea {
            width: 50%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 4px;
            font-size: 14px;
        }

        textarea {
            min-height: 120px;
        }

        .alert-success {
            background: #c6f6d5;
            color: #22543d;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="/">Main page</a>
        @if(session()->has('user_id'))
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('posts.index') }}">Posts</a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @else
        <a href="{{ route('login.show') }}">Login</a>
        <a href="{{ route('register.show') }}">SignUp</a>
        @endif
    </nav>

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</body>

</html>