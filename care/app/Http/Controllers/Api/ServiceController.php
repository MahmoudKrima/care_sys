<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\ApiResponseTrait;
use Google\Service\Books\Reource\Series;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=Service::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=Service::where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Service Successfully'),200);
    }
}
