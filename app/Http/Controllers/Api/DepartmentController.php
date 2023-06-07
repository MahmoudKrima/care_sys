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
    $data = ServiceCategory::all();

    $localizedData = [];

    foreach ($data as $item) {
        $localizedItem = [
            'id' => $item->id,
            'name' => app()->getLocale() === 'en' ? $item->name_en : $item->name_ar,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'image' => app()->getLocale() === 'en' ? $item->image_en : $item->image_ar,
            'status' => $item->status,
        ];

        $localizedData[] = $localizedItem;
    }

    return ApiResponseTrait::apiResponse($localizedData, 'Get All Data Successfully', 200);
}


public function topDepartments()
{
    $data = ServiceCategory::where('status', 1)->get();

    $localizedData = [];

    foreach ($data as $item) {
        $localizedItem = [
            'id' => $item->id,
            'name' => app()->getLocale() === 'en' ? $item->name_en : $item->name_ar,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'image' => app()->getLocale() === 'en' ? $item->image_en : $item->image_ar,
            'status' => $item->status,
        ];

        $localizedData[] = $localizedItem;
    }

    return ApiResponseTrait::apiResponse($localizedData, 'Get All Data Successfully', 200);
}


public function show(Request $request)
{
    $locale = app()->getLocale();
    $data = null;

    if ($locale == 'en') {
        $data = ServiceCategory::where('id', $request->id)
            ->with(['services' => function ($query) {
                $query->select('id', 'category_id', 'name_en as name', 'charges', 'status', 'created_at', 'updated_at', 'short_description_en', 'image_en as image', 'specialization_id')
                    ->withCount('serviceDoctors');
            }])
            ->select('id', 'name_en as name', 'created_at', 'updated_at', 'image_en as image', 'status')
            ->first();
    } elseif ($locale == 'ar') {
        $data = ServiceCategory::where('id', $request->id)
            ->with(['services' => function ($query) {
                $query->select('id', 'category_id', 'name_ar as name', 'charges', 'status', 'created_at', 'updated_at', 'short_description_ar', 'image_ar as image', 'specialization_id')
                    ->withCount('serviceDoctors');
            }])
            ->select('id', 'name_ar as name', 'created_at', 'updated_at', 'image_ar as image', 'status')
            ->first();
    }

    $responseData = [
        'data' => $data,
        'message' => 'Get Department Successfully',
        'status' => 200
    ];

    return response()->json($responseData, 200);
}



}
