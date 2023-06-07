<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PharmacyCategory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    Use ApiResponseTrait;

    public function index()
{
    $locale = app()->getLocale();
    $data = PharmacyCategory::all();
    
    $responseData = [];
    foreach ($data as $item) {
        $title = ($locale === 'en') ? $item->title_en : $item->title_ar;
        $responseData[] = [
            'id' => $item->id,
            'title' => $title,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    }
    
    return ApiResponseTrait::apiResponse($responseData, 'Get All Data Successfully', 200);
}


public function show(Request $request)
{
    $locale = app()->getLocale();
    $data = PharmacyCategory::with('medicine')->where('id', $request->id)->first();
    
    $responseData = [
        'id' => $data->id,
        'title' => ($locale === 'en') ? $data->title_en : $data->title_ar,
        'created_at' => $data->created_at,
        'updated_at' => $data->updated_at,
        'medicine' => []
    ];
    
    foreach ($data->medicine as $medicine) {
        $title = ($locale === 'en') ? $medicine->title_en : $medicine->title_ar;
        $size_category = ($locale === 'en') ? $medicine->size_category_en : $medicine->size_category_ar;
        
        $responseData['medicine'][] = [
            'id' => $medicine->id,
            'title' => $title,
            'image' => $medicine->image,
            'category_id' => $medicine->category_id,
            'size' => $medicine->size,
            'size_category' => $size_category,
            'price' => $medicine->price,
            'sale' => $medicine->sale,
            'stock' => $medicine->stock,
            'created_at' => $medicine->created_at,
            'updated_at' => $medicine->updated_at
        ];
    }
    
    return ApiResponseTrait::apiResponse($responseData, 'Get Category Successfully', 200);
}

}
