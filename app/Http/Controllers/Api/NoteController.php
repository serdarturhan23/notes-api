<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Notes",
    description: "Notes endpoints"
)]
class NoteController extends Controller
{
    #[OA\Get(
        path: "/api/notes",
        tags: ["Notes"],
        summary: "List notes",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "status",
                in: "query",
                required: false,
                description: "Filter by status: completed or pending",
                schema: new OA\Schema(type: "string", example: "completed")
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Notes list"),
            new OA\Response(response: 401, description: "Unauthenticated"),
        ]
    )]
    public function index(Request $request)
    {
        $query = $request->user()->notes();

        if ($request->has('status')) {
            if ($request->status === 'completed') {
                $query->where('is_completed', true);
            }

            if ($request->status === 'pending') {
                $query->where('is_completed', false);
            }
        }

        $notes = $query->latest()->get();

        return response()->json($notes);
    }

    #[OA\Post(
        path: "/api/notes",
        tags: ["Notes"],
        summary: "Create note",
        security: [["bearerAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["title"],
                properties: [
                    new OA\Property(property: "title", type: "string", example: "İlk not"),
                    new OA\Property(property: "content", type: "string", example: "Laravel API çalışıyor"),
                    new OA\Property(property: "due_date", type: "string", format: "date", example: "2026-04-05"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Note created"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 422, description: "Validation error"),
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $note = $request->user()->notes()->create($validated);

        return response()->json([
            'message' => 'Not oluşturuldu',
            'note' => $note,
        ], 201);
    }

    #[OA\Get(
        path: "/api/notes/{note}",
        tags: ["Notes"],
        summary: "Show note",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "note",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Note details"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden"),
        ]
    )]
    public function show(Request $request, Note $note)
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        return response()->json($note);
    }

    #[OA\Put(
        path: "/api/notes/{note}",
        tags: ["Notes"],
        summary: "Update note",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "note",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "title", type: "string", example: "İlk not güncellendi"),
                    new OA\Property(property: "content", type: "string", example: "İçerik değişti"),
                    new OA\Property(property: "due_date", type: "string", format: "date", example: "2026-04-10"),
                    new OA\Property(property: "is_completed", type: "boolean", example: false),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Note updated"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden"),
        ]
    )]
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_completed' => 'nullable|boolean',
        ]);

        $note->update($validated);

        return response()->json([
            'message' => 'Not güncellendi',
            'note' => $note,
        ]);
    }

    #[OA\Delete(
        path: "/api/notes/{note}",
        tags: ["Notes"],
        summary: "Delete note",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "note",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Note deleted"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden"),
        ]
    )]
    public function destroy(Request $request, Note $note)
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $note->delete();

        return response()->json([
            'message' => 'Not silindi',
        ]);
    }

    #[OA\Patch(
        path: "/api/notes/{note}/complete",
        tags: ["Notes"],
        summary: "Mark note as completed",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "note",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Note completed"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden"),
        ]
    )]
    public function complete(Request $request, Note $note)
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $note->update([
            'is_completed' => true,
        ]);

        return response()->json([
            'message' => 'Not tamamlandı olarak işaretlendi',
            'note' => $note,
        ]);
    }
}