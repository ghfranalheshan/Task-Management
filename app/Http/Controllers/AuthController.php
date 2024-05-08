<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;
class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
       return Response()->json($this->authService->register($request->validated()),Response::HTTP_CREATED);
    }
    /**
     *
     */

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
       return Response()->json($this->authService->login($request->validated()),Response::HTTP_OK);
    }
  /**
     *
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
       return Response()->json($this->authService->logout(),Response::HTTP_OK);
    }
}
