@extends('layout')

@section('content')
    <h1>Notes App</h1>
    <p class="muted">
        Laravel ile geliştirilmiş basit bir not uygulaması.
        Kayıt olabilir, giriş yapabilir ve notlarını yönetebilirsin.
    </p>

    <div class="row">
        <a class="btn" href="{{ route('register') }}">Kayıt Ol</a>
        <a class="btn btn-secondary" href="{{ route('login') }}">Giriş Yap</a>
        <a class="btn btn-success" href="/api/documentation">Swagger Docs</a>
    </div>
@endsection