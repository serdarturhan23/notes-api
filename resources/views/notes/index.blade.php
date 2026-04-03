@extends('layout')

@section('content')
    <h2>Notlarım</h2>

    <div class="row" style="margin-bottom: 20px;">
        <a class="btn {{ !$status ? 'btn-success' : '' }}" href="{{ route('dashboard') }}">Tümü</a>
        <a class="btn {{ $status === 'completed' ? 'btn-success' : 'btn-secondary' }}" href="{{ route('dashboard', ['status' => 'completed']) }}">Tamamlananlar</a>
        <a class="btn {{ $status === 'pending' ? 'btn-success' : 'btn-secondary' }}" href="{{ route('dashboard', ['status' => 'pending']) }}">Bekleyenler</a>
        <a class="btn" href="{{ route('notes.create') }}">Yeni Not</a>
    </div>

    @forelse($notes as $note)
        <div class="note">
            <h3>{{ $note->title }}</h3>

            <p class="muted" style="margin: 10px 0;">
                {{ $note->content ?: 'İçerik yok.' }}
            </p>

            <p>
                Durum:
                <strong>{{ $note->is_completed ? 'Tamamlandı' : 'Bekliyor' }}</strong>
            </p>

            <div class="row">
                <a class="btn btn-secondary" href="{{ route('notes.edit', $note->id) }}">Düzenle</a>

                <form class="inline" method="POST" action="{{ route('notes.complete', $note->id) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success" type="submit">
                        {{ $note->is_completed ? 'Bekliyor Yap' : 'Tamamlandı Yap' }}
                    </button>
                </form>

                <form class="inline" method="POST" action="{{ route('notes.destroy', $note->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Sil</button>
                </form>
            </div>
        </div>
    @empty
        <p class="muted">Henüz not yok.</p>
    @endforelse
@endsection