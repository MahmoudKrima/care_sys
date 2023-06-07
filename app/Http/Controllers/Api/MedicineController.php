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
        $locale = app()->getLocale();
        $data = Medicine::with('pharmacy')->get();
    
        $responseData = [];
        
        foreach ($data as $item) {
            $pharmacyTitle = ($locale === 'en') ? $item->pharmacy->title_en : $item->pharmacy->title_ar;
            $sizeCategory = ($locale === 'en') ? $item->size_category_en : $item->size_category_ar;
    
            $responseData[] = [
                'id' => $item->id,
                'title' => ($locale === 'en') ? $item->title_en : $item->title_ar,
                'image' => $item->image,
                'category_id' => $item->category_id,
                'size' => $item->size,
                'size_category' => $sizeCategory,
                'price' => $item->price,
                'sale' => $item->sale,
                'stock' => $item->stock,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'pharmacy' => [
                    'id' => $item->pharmacy->id,
                    'title' => $pharmacyTitle,
                    'created_at' => $item->pharmacy->created_at,
                    'updated_at' => $item->pharmacy->updated_at
                ]
            ];
        }
    
        return ApiResponseTrait::apiResponse($responseData, 'Get All Data Successfully', 200);
    }
    

    public function show(Request $request)
{
    $locale = app()->getLocale();
    $data = Medicine::with(['pharmacy' => function ($query) use ($locale) {
        $query->select('id', "title_$locale as title", "title_$locale as title_$locale", 'created_at', 'updated_at');
    }, 'details' => function ($query) use ($locale) {
        $query->select('id', 'medicine_id', "details_$locale as details", "how_to_use_$locale as how_to_use", "details_$locale as details_$locale", "how_to_use_$locale as how_to_use_$locale", 'created_at', 'updated_at');
    }])->where('id', $request->id)->first();

    if ($data) {
        $data['price_after_sale'] = $data['price'] - ($data['price'] * ($data['sale'] / 100));

        if ($locale === 'en') {
            $data['title'] = $data['title_en'];
            $data['size_category'] = $data['size_category_en'];
            $data['pharmacy']['title'] = $data['pharmacy']['title_en'];
            $data['details']['details'] = $data['details']['details_en'];
            $data['details']['how_to_use'] = $data['details']['how_to_use_en'];
            unset($data['pharmacy']['title_ar'], $data['details']['details_ar'], $data['details']['how_to_use_ar']);
        } else {
            $data['title'] = $data['title_ar'];
            $data['size_category'] = $data['size_category_ar'];
            $data['pharmacy']['title'] = $data['pharmacy']['title_ar'];
            $data['details']['details'] = $data['details']['details_ar'];
            $data['details']['how_to_use'] = $data['details']['how_to_use_ar'];
            unset($data['pharmacy']['title_en'], $data['details']['details_en'], $data['details']['how_to_use_en']);
        }

        unset($data['title_en'], $data['title_ar'], $data['size_category_en'], $data['size_category_ar']);

        // Remove unrelated language-specific data for related models
        unset($data['pharmacy']['title_ar'], $data['details']['details_ar'], $data['details']['how_to_use_ar'], $data['details']['details_en'], $data['details']['how_to_use_en']);
    }

    return ApiResponseTrait::apiResponse($data, 'Get Medicine Successfully', 200);
}

    

}
