<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=Offer::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=Offer::with('details')->where('id',$request->id)->first();
        if($data){
            $data['image']='https://d.msarweb.net/public/'.$data->image;
            $data['price_after_sale'] = $data['price'] - ($data['price'] * ($data['sale'] / 100));
        }
        return ApiResponseTrait::apiResponse($data,('Get Offer Successfully'),200);
    }
}
