<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeVisits;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class HomeVisitController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=HomeVisits::with('subVisit')->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=HomeVisits::with('subVisit')->where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Category Successfully'),200);
    }
}
