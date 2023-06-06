<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=ServiceCategory::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function topDepartments()
    {
        $data=ServiceCategory::where('status',1)->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request){
        $data = ServiceCategory::where('id', $request->id)
        ->with(['services' => function ($query) {
            $query->withCount('serviceDoctors');
        }])
        ->first();
        return ApiResponseTrait::apiResponse($data,('Get Department Successfully'),200);
    }

}
