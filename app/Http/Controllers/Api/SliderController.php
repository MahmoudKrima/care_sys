<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=Slider::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }
}
