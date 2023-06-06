<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diseases;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class DiseasController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=Diseases::with('specialist')->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=Diseases::with('specialist')->where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Disease Successfully'),200);
    }
}
