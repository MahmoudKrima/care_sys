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
        $locale = app()->getLocale();
    
        $data = Offer::all()->map(function ($offer) use ($locale) {
            return [
                'id' => $offer->id,
                'title' => $locale === 'en' ? $offer->title_en : $offer->title_ar,
                'image' => $locale === 'en' ? $offer->image_en : $offer->image_ar,
                'price' => $offer->price,
                'sale' => $offer->sale,
                'stock' => $offer->stock,
                'type' => $locale === 'en' ? $offer->type_en : $offer->type_ar,
                'type_description' => $locale === 'en' ? $offer->type_description_en : $offer->type_description_ar,
                'brand' => $locale === 'en' ? $offer->brand_en : $offer->brand_ar,
                'age' => $locale === 'en' ? $offer->age_en : $offer->age_ar,
                'status' => $offer->status,
                'created_at' => $offer->created_at,
                'updated_at' => $offer->updated_at
            ];
        });
    
        return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
    }
    
    public function show(Request $request)
    {
        $locale = app()->getLocale();
    
        $data = Offer::with('details')->where('id', $request->id)->first();
    
        if ($data) {
            $data['price_after_sale'] = $data['price'] - ($data['price'] * ($data['sale'] / 100));
    
            $titleKey = 'title_' . $locale;
            $typeKey = 'type_' . $locale;
            $typeDescKey = 'type_description_' . $locale;
            $brandKey = 'brand_' . $locale;
            $ageKey = 'age_' . $locale;
            $imageKey = 'image_' . $locale;
    
            $data['title'] = $data[$titleKey];
            $data['type'] = $data[$typeKey];
            $data['type_description'] = $data[$typeDescKey];
            $data['brand'] = $data[$brandKey];
            $data['age'] = $data[$ageKey];
            $data['image'] = $data[$imageKey];

    
            $detailsKey = 'details_' . $locale;
            $howToUseKey = 'how_to_use_' . $locale;
            $details = $data['details'];
            $details['details'] = $details[$detailsKey];
            $details['how_to_use'] = $details[$howToUseKey];
            $data['details'] = $details;
    
            // Remove unnecessary language fields
            foreach (['title_en', 'title_ar', 'type_en', 'type_ar', 'type_description_en', 'type_description_ar', 'brand_en', 'brand_ar', 'age_en', 'age_ar', 'image_en', 'image_ar'] as $field) {
                unset($data[$field]);
            }
    
            $detailsFields = ['details_en', 'details_ar', 'how_to_use_en', 'how_to_use_ar'];
            foreach ($detailsFields as $field) {
                unset($data['details'][$field]);
            }
        }
    
        return ApiResponseTrait::apiResponse($data, 'Get Offer Successfully', 200);
    }
    


}
