<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $locale = app()->getLocale();
    
        $data = Slider::all()->map(function ($slider) use ($locale) {
            return [
                'id' => $slider->id,
                'title' => $locale === 'en' ? $slider->title_en : $slider->title_ar,
                'short_description' => $locale === 'en' ? $slider->short_description_en : $slider->short_description_ar,
                'image' => $locale === 'en' ? $slider->image_en : $slider->image_ar,
                'slider_image' => $slider->slider_image,
            ];
        });
    
        return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
    }
    
}
