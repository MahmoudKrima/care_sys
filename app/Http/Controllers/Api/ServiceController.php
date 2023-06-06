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
        $data = Service::withCount('serviceDoctors')->get();
        return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
    }

    public function show(Request $request)
    {
        $data = Service::where('id', $request->id)
        ->with('serviceDoctors.details', 'serviceDoctors.reviews','serviceDoctors.appointment')
        ->first();
    
    foreach ($data->serviceDoctors as $doctor) {
        $reviews = $doctor->reviews;
        $totalReviews = $reviews->count();
        $sumRatings = $reviews->sum('rating');
        $averageRating = $totalReviews > 0 ? $sumRatings / $totalReviews : 0;
        
        $data['Average_review'] = $averageRating;
    }
    // foreach ($data->serviceDoctors->appointment as $appointment) {
    //     $carbonDate = Carbon::parse($appointment->from_date);
    //     $formattedDate = $carbonDate->isoFormat('MMM D [at] h:mm A');
    //     $data['available_at'] = $formattedDate;
    // }
    return ApiResponseTrait::apiResponse($data,('Get Service Successfully'),200);
    }

    public function DoctorDetails(Request $request)
    {
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
    'images' => $data->images,
    'reviews' => []
];

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
    $service = Service::where('id', $request->id)
        ->with('serviceDoctors.specialization', 'serviceDoctors.details', 'serviceDoctors.reviews')
        ->first();

    $data = [
        'service' => [
            'id' => $service->id,
            'name' => $service->name
        ],
        'doctors' => []
    ];

    foreach ($service->serviceDoctors as $serviceDoctor) {
        $specializations = $serviceDoctor->specialization->map(function ($specialization) {
            return [
                'id' => $specialization->id,
                'name' => $specialization->name
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
