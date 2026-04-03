<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        }
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
            flex-wrap: wrap;
        }
        .nav a, .btn {
            text-decoration: none;
            background: #4f46e5;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: inline-block;
        }
        .btn-danger { background: #dc2626; }
        .btn-secondary { background: #6b7280; }
        .btn-success { background: #16a34a; }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
        }
        h1, h2, h3 { margin-bottom: 16px; }
        .note {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 14px;
        }
        .muted { color: #6b7280; }
        .row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }
        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }
        form.inline {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <div>
                <a href="{{ route('home') }}">Ana Sayfa</a>
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('notes.create') }}">Yeni Not</a>
                @endauth
            </div>

            <div>
                @guest
                    <a href="{{ route('login') }}">Giriş Yap</a>
                    <a href="{{ route('register') }}">Kayıt Ol</a>
                @endguest

                @auth
                    <form class="inline" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Çıkış Yap</button>
                    </form>
                @endauth
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="card">
            @yield('content')
        </div>
    </div>
</body>
</html>