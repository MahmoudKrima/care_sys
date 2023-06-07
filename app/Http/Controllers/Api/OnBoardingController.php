<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OnBoarding;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;


class OnBoardingController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $locale = app()->getLocale();
    
        $data = OnBoarding::select([
            'id',
            'title_' . $locale . ' as title',
            'description_' . $locale . ' as description',
            'image_' . $locale .' as image',
            'created_at',
            'updated_at'
        ])->get();
    
        return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
    }
    
}
