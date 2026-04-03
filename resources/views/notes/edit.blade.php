@extends('layout')

@section('content')
    <h2>Not Düzenle</h2>

    <form method="POST" action="{{ route('notes.update', $note->id) }}">
        @csrf
        @method('PUT')

        <label>Başlık</label>
        <input type="text" name="title" value="{{ old('title', $note->title) }}" required>

        <label>İçerik</label>
        <textarea name="content" rows="6">{{ old('content', $note->content) }}</textarea>

        <button class="btn" type="submit">Güncelle</button>
    </form>
@endsection