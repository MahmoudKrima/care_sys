<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PharmacyCategory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=PharmacyCategory::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=PharmacyCategory::with('medicine')->where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Category Successfully'),200);
    }
}
