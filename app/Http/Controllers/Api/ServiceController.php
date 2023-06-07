<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    Use ApiResponseTrait;

    public function index()
{
    $locale = app()->getLocale();
    $data = null;

    if ($locale == 'en') {
        $data = Service::withCount('serviceDoctors')
            ->select('id', 'category_id', 'name_en as name', 'charges', 'status', 'created_at', 'updated_at', 'short_description_en as short_description', 'image_en as image', 'specialization_id')
            ->get();
    } elseif ($locale == 'ar') {
        $data = Service::withCount('serviceDoctors')
            ->select('id', 'category_id', 'name_ar as name', 'charges', 'status', 'created_at', 'updated_at', 'short_description_ar as short_description', 'image_ar as image', 'specialization_id')
            ->get();
    }

    return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
}


public function show(Request $request)
{
    $locale = app()->getLocale();

    $data = Service::where('id', $request->id)
        ->with('serviceDoctors.details', 'serviceDoctors.reviews', 'serviceDoctors.appointment')
        ->first();

    foreach ($data->serviceDoctors as $doctor) {
        $reviews = $doctor->reviews;
        $totalReviews = $reviews->count();
        $sumRatings = $reviews->sum('rating');
        $averageRating = $totalReviews > 0 ? $sumRatings / $totalReviews : 0;

        $data['Average_review'] = $averageRating;
    }

    $localizedFields = [
        'name' => 'name_' . $locale,
        'short_description' => 'short_description_' . $locale,
        'image' => 'image_' . $locale,
    ];

    $localizedData = [];

    foreach ($localizedFields as $field => $localizedField) {
        if (isset($data->$localizedField)) {
            $localizedData[$field] = $data->$localizedField;
        }
    }

    $data->fill($localizedData);

    unset($data->name_en, $data->name_ar, $data->short_description_en, $data->short_description_ar, $data->image_en, $data->image_ar);

    return ApiResponseTrait::apiResponse($data, 'Get Service Successfully', 200);
}

public function DoctorDetails(Request $request)
{
    $locale = app()->getLocale();

    $data = User::where('id', $request->id)
        ->with('details', 'reviews.patient', 'images')
        ->withCount('reviews')
        ->first();

    $doctorDetails = [
        'id' => $data->id,
        'full_name' => $data->first_name . ' ' . $data->last_name,
        'average_rating' => $data->reviews->avg('rating'),
        'reviews_count' => $data->reviews_count,
        'introduction' => $data->details->informations,
        'other_information' => $data->details->another_informations,
        'profile' => $data->details->profile,
        'images' => [],
        'reviews' => []
    ];

    foreach ($data->images as $image) {
        $imagePath = $image->{'image_'.$locale};

        if (!empty($imagePath)) {
            $doctorDetails['images'][] = [
                'id' => $image->id,
                'doctor_id' => $image->doctor_id,
                'image' => $imagePath,
                'created_at' => $image->created_at,
                'updated_at' => $image->updated_at
            ];
        }
    }

    foreach ($data->reviews as $review) {
        $patientName = $review->patient ? $review->patient->first_name . ' ' . $review->patient->last_name : 'N/A';

        $doctorDetails['reviews'][] = [
            'id' => $review->id,
            'patient_name' => $patientName,
            'rating' => $review->rating,
            'review' => $review->review,
        ];
    }

    return ApiResponseTrait::apiResponse($doctorDetails, 'Get Doctor Successfully', 200);
}

    

public function allDoctors(Request $request)
{
    $locale = app()->getLocale();

    $service = Service::where('id', $request->id)
        ->with('serviceDoctors.specialization', 'serviceDoctors.details', 'serviceDoctors.reviews')
        ->first();

    $data = [
        'service' => [
            'id' => $service->id,
            'name' => $locale === 'en' ? $service->name_en : $service->name_ar
        ],
        'doctors' => []
    ];

    foreach ($service->serviceDoctors as $serviceDoctor) {
        $specializations = $serviceDoctor->specialization->map(function ($specialization) use ($locale) {
            return [
                'id' => $specialization->id,
                'name' => $locale === 'en' ? $specialization->name_en : $specialization->name_ar
            ];
        });

        $doctor = [
            'id' => $serviceDoctor->id,
            'full_name' => $serviceDoctor->first_name . ' ' . $serviceDoctor->last_name,
            'price' => $serviceDoctor->details->price,
            'profile' => $serviceDoctor->details->profile,
            'average_review' => $serviceDoctor->reviews->avg('rating'),
            'specialization' => $specializations
        ];
        $data['doctors'][] = $doctor;
    }

    return ApiResponseTrait::apiResponse($data, 'Get Doctor Successfully', 200);
}

    
}
