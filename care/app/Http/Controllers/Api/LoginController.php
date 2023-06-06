<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    Use ApiResponseTrait;

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        // Auth::session()->regenerate();

        return ApiResponseTrait::apiResponse([],('User Logged In Successfully'),200);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return ApiResponseTrait::apiResponse([],('User Logged Out Successfully'),200);
    }


}
