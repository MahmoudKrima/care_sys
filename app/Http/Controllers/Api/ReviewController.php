<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Review;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data = Review::with('doctor','patient')
            ->get();

            return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
        }


    public function store(Request $request)
    {
        $patient = Patient::where('user_id', $request->patient_id)->first();
        $doctor = Doctor::where('user_id',$request->doctor_id)->first();
        Review::create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        Notification::create([
            'title' => $patient->full_name.' just added '.$request->rating.' star review for you.',
            'type' => Notification::REVIEW,
            'user_id' => Doctor::whereId($doctor->id)->first()->user_id,
        ]);

        return ApiResponseTrait::apiResponse([],('Review Created Successfully'),200);
    }

    public function update(Request $request)
    {
        $patient = Patient::where('user_id', $request->patient_id)->first();
        $doctor = Doctor::where('user_id',$request->doctor_id)->first();
        Review::where('id',$request->id)->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        Notification::create([
            'title' => $patient->full_name.' just added '.$request->rating.' star review for you.',
            'type' => Notification::REVIEW,
            'user_id' => Doctor::whereId($doctor->id)->first()->user_id,
        ]);
        return ApiResponseTrait::apiResponse([],('Review Edited Successfully'),200);

    }
}
