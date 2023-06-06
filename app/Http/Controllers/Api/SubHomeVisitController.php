<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubHomeVisits;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SubHomeVisitController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=SubHomeVisits::with('homeVisit')->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=SubHomeVisits::with('homeVisit')->where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Sub Category Successfully'),200);
    }
}
