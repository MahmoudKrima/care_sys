<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubHomeVisits;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SubHomeVisitController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $locale = app()->getLocale();
        $data = SubHomeVisits::with(['homeVisit' => function ($query) use ($locale) {
            $query->select('id', "title_$locale as title", 'created_at', 'updated_at');
        }])->select('id', "title_$locale as title", 'home_visit_id', 'created_at', 'updated_at')->get();
    
        return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
    }
    

    public function show(Request $request)
{
    $locale = app()->getLocale();
    $data = SubHomeVisits::with(['homeVisit' => function ($query) use ($locale) {
        $query->select('id', "title_$locale as title", 'created_at', 'updated_at');
    }])->select('id', "title_$locale as title", 'home_visit_id', 'created_at', 'updated_at')
      ->where('id', $request->id)
      ->first();

    return ApiResponseTrait::apiResponse($data, 'Get Sub Category Successfully', 200);
}

}
