<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\VisitBook;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VisitBookController extends Controller
{
    Use ApiResponseTrait;

    public function index(Request $request)
    {
        $data=VisitBook::with('patient','subVisit')->where('patient_id',$request->patient_id)->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show(Request $request)
    {
        $data=VisitBook::with('patient','subVisit')->where('id',$request->id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Book Successfully'),200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required'],
            'attachments[]' => ['file', 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,jpeg,png,bmp,tiff', 'max:204800', 'sometimes'],
        ]);
    
        $visit = VisitBook::create([
            'patient_id' => $request->patient_id,
            'sub_visit_id' => $request->sub_visit_id,
            'notes' => $request->notes,
            'address' => $request->address,
        ]);

        // Attachments
        if ($request->hasFile('attachments')) {
            $attachmentPaths = [];
            foreach ($request->file('attachments') as $file) {
                    $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                    $filePath = 'upload/patient/attachments/' . $fileName;
                    if ($file->move(public_path('upload/patient/attachments/'), $fileName)) {
                        $attachmentPaths[] = $filePath;
                    } else {
                        return ApiResponseTrait::apiResponse([], 'Failed to move file to destination', Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
              
            }
            $visit->attachments = json_encode($attachmentPaths);
        }
        $user=User::where('id',$request->patient_id)->first();
    
        // Voice Note
        if ($request->hasFile('voice_notes')) {
            $voiceNote = $request->file('voice_notes');
            if ($voiceNote->isValid()) {
                $fileName = hexdec(uniqid()) . '.' . $voiceNote->getClientOriginalExtension();
                $filePath = 'upload/patient/booking/' . $fileName;
                if ($voiceNote->move(public_path('upload/patient/booking/'), $fileName)) {
                    $visit->voice_notes = $filePath;
                } else {
                    return ApiResponseTrait::apiResponse([], 'Failed to move voice note file to destination', Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                return ApiResponseTrait::apiResponse([], 'Invalid voice note file', Response::HTTP_BAD_REQUEST);
            }
        }
        $visit->save();
        Notification::create([
            'title' => $user->first_name . ' ' . $user->last_name .'Just Booked A Visit',
            'type' => Notification::BOOK,
            'user_id' => 1,
        ]);
        return ApiResponseTrait::apiResponse([], 'Visit Booked Successfully', Response::HTTP_OK);
    }
    
    
}
