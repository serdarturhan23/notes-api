<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Notes API",
    description: "Laravel REST API for user authentication and notes management"
)]
#[OA\Server(
    url: "http://127.0.0.1:8000",
    description: "Local server"
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT",
    description: "Bearer token authentication"
)]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}