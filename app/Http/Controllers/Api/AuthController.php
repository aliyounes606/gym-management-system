<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    use ApiResponseTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Summary of register
     * @param \App\Http\Requests\Api\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->authService->registerUser($request->validated());

            return $this->successResponse(
                $result,
                'تم إنشاء الحساب بنجاح!',
                201
            );

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    /**
     * Summary of login
     * @param \App\Http\Requests\Api\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->loginUser($request->email, $request->password);

            return $this->successResponse(
                $result,
                'تم تسجيل الدخول بنجاح!'
            );

        } catch (Exception $e) {
            $code = $e->getCode() ?: 401;
            return $this->errorResponse($e->getMessage(), $code);
        }
    }
    /**
     * Summary of logout
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $this->authService->logoutUser($request->user());

            return $this->successResponse([], 'تم تسجيل الخروج بنجاح!');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}