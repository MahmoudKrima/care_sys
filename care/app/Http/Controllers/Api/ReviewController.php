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

    /**
     * @param  CreateReviewRequest  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $patient = User::where('id', $request->id)->get();
        Review::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $patient->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        Notification::create([
            'title' => $patient->full_name.' just added '.$request->rating.' star review for you.',
            'type' => Notification::REVIEW,
            'user_id' => Doctor::whereId($request->doctor_id)->first()->user_id,
        ]);

        return ApiResponseTrait::apiResponse([],('Review Created Successfully'),200);
    }

    /**
     * @param  Review  $review
     * @return mixed
     */
    public function edit(Review $review)
    {
        $canEditReview = Review::whereId($review->id)->wherePatientId(getLogInUser()->patient->id);
        if(!$canEditReview->exists()){
            return $this->sendError('Seems, you are not allowed to access this record.');
        }
        return ApiResponseTrait::apiResponse([],('Review Edited Successfully'),200);
    }

    /**
     * @param  UpdateReviewRequest  $request
     * @param  Review  $review
     * @return mixed
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->all();
        $review->update($data);

        return $this->sendSuccess(__('messages.flash.review_edit'));
    }
}
