<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=Medicine::with('pharmacy')->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=Medicine::with('pharmacy')->where('id',$request->id)->first();
        if($data){
            $data['price_after_sale'] = $data['price'] - ($data['price'] * ($data['sale'] / 100));
        }
        return ApiResponseTrait::apiResponse($data,('Get Medicine Successfully'),200);
    }
}
