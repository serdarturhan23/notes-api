<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteWebController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Note::where('user_id', Auth::id())->latest();

        if ($status === 'completed') {
            $query->where('is_completed', true);
        }

        if ($status === 'pending') {
            $query->where('is_completed', false);
        }

        $notes = $query->get();

        return view('notes.index', compact('notes', 'status'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        Note::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'is_completed' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Not oluşturuldu.');
    }

    public function edit(Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $note->update([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Not güncellendi.');
    }

    public function destroy(Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $note->delete();

        return redirect()->route('dashboard')->with('success', 'Not silindi.');
    }

    public function toggleComplete(Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $note->update([
            'is_completed' => !$note->is_completed,
        ]);

        return redirect()->route('dashboard')->with('success', 'Not durumu güncellendi.');
    }
}