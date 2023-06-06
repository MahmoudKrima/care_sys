<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfferDetails;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OfferDetailsController extends Controller
{
    Use ApiResponseTrait;

    public function show($id)
    {
        $data=OfferDetails::where('offer_id',$id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Offer Successfully'),200);
    }

}
