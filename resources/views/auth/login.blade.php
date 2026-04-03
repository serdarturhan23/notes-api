@extends('layout')

@section('content')
    <h2>Giriş Yap</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Şifre</label>
        <input type="password" name="password" required>

        <button class="btn" type="submit">Giriş Yap</button>
    </form>
@endsection