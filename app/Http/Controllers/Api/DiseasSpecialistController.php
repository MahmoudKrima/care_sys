<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class DiseasSpecialistController extends Controller
{
    Use ApiResponseTrait;

    public function index()
{
    $locale = app()->getLocale();
    $data = Specialization::with(['diseases' => function ($query) use ($locale) {
        $query->select('id', "title_$locale as title", "image_$locale as image", 'specialist_id', 'created_at', 'updated_at');
    }])->select("id", "name_$locale as name", 'created_at', 'updated_at')->get();

    return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
}

public function show(Request $request)
{
    $locale = app()->getLocale();
    $data = Specialization::with(['diseases' => function ($query) use ($locale) {
        $query->select('id', "title_$locale as title", "image_$locale as image", 'specialist_id', 'created_at', 'updated_at');
    }])->select("id", "name_$locale as name", 'created_at', 'updated_at')->where('id', $request->id)->first();

    return ApiResponseTrait::apiResponse($data, 'Get Specialization Successfully', 200);
}

}
