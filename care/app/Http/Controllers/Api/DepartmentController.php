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

}
