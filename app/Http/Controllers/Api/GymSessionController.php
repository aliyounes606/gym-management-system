<?php

namespace App\Http\Controllers\Api;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GymSessionService;
class GymSessionController extends Controller
{
    use ApiResponseTrait;

    protected GymSessionService $gymSessionService;

    public function __construct(GymSessionService $gymSessionService)
    {
        $this->gymSessionService = $gymSessionService;
    }
    // عرض كل الجلسات مع فلترة
    public function index(Request $request)
    {
        return $this->gymSessionService->indexgymsession($request);
    }
    // عرض جلسة واحدة
    public function show($id)
    {
        return $this->gymSessionService->showgymsession($id);
    }
}
