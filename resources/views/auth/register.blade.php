@extends('layout')

@section('content')
    <h2>Kayıt Ol</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Ad</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Şifre</label>
        <input type="password" name="password" required>

        <label>Şifre Tekrar</label>
        <input type="password" name="password_confirmation" required>

        <button class="btn" type="submit">Kayıt Ol</button>
    </form>
@endsection