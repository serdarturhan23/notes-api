@extends('layout')

@section('content')
    <h2>Yeni Not Oluştur</h2>

    <form method="POST" action="{{ route('notes.store') }}">
        @csrf

        <label>Başlık</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label>İçerik</label>
        <textarea name="content" rows="6">{{ old('content') }}</textarea>

        <button class="btn" type="submit">Kaydet</button>
    </form>
@endsection