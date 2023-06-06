<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class DiseasSpecialistController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=Specialization::with('diseases')->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=Specialization::with('diseases')->where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Specialization Successfully'),200);
    }
}
