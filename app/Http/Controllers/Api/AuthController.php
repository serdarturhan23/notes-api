<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Auth",
    description: "Authentication endpoints"
)]
class AuthController extends Controller
{
    #[OA\Post(
        path: "/api/register",
        tags: ["Auth"],
        summary: "Register a new user",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "email", "password", "password_confirmation"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Serdar"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "serdar@test.com"),
                    new OA\Property(property: "password", type: "string", example: "123456"),
                    new OA\Property(property: "password_confirmation", type: "string", example: "123456"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "User created"),
            new OA\Response(response: 422, description: "Validation error"),
        ]
    )]
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Doğrulama hatası',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Kullanıcı oluşturuldu',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    #[OA\Post(
        path: "/api/login",
        tags: ["Auth"],
        summary: "Login user",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["email", "password"],
                properties: [
                    new OA\Property(property: "email", type: "string", format: "email", example: "serdar@test.com"),
                    new OA\Property(property: "password", type: "string", example: "123456"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Login success"),
            new OA\Response(response: 401, description: "Invalid credentials"),
            new OA\Response(response: 422, description: "Validation error"),
        ]
    )]
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Doğrulama hatası',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email veya şifre hatalı.',
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Giriş başarılı',
            'user' => $user,
            'token' => $token,
        ]);
    }

    #[OA\Post(
        path: "/api/logout",
        tags: ["Auth"],
        summary: "Logout user",
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(response: 200, description: "Logout success"),
            new OA\Response(response: 401, description: "Unauthenticated"),
        ]
    )]
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Çıkış yapıldı',
        ]);
    }
}