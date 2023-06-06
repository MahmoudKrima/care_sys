<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OnBoarding;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;


class OnBoardingController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=OnBoarding::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }
}
