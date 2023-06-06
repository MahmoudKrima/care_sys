<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\VisitBook;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VisitBookController extends Controller
{
    Use ApiResponseTrait;

    public function index()
    {
        $data=VisitBook::with('patient','subVisit')->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function show($id)
    {
        $data=VisitBook::with('patient','subVisit')->where('id',$id)->first();
        return ApiResponseTrait::apiResponse($data,('Get Book Successfully'),200);
    }

   public function store(Request $request)
{
    $request->validate([
        'appointments' => ['required'],
        'address' => ['required'],
        'attachments' => ['file', 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,jpeg,png,bmp,tiff', 'max:204800', 'sometimes'],
    ]);

    $visit = VisitBook::create([
        'patient_id' => 3,
        'appointments' => $request->appointments,
        'sub_visit_id' => $request->sub_visit_id,
        'notes' => $request->notes,
        'address' => $request->address,
    ]);

    // Attachments
    if ($request->hasFile('attachments')) {
        $file_store = [];
        foreach ($request->file('attachments') as $file) {
            if ($file->isValid()) {
                $file_name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $files_save = 'upload/patient/attachments/' . $file_name;
                $file->move(public_path('upload/patient/attachments/'), $file_name);
                $file_store[] = $files_save;
            }
        }
        $file_store = json_encode($file_store);
        $visit->attachments = $file_store;
        $visit->save();
    }

    // Voice Note
    if ($request->hasFile('voice_notes')) {
        $voice_note = $request->file('voice_notes');
        if ($voice_note->isValid()) {
            $name_gen1 = hexdec(uniqid()) . '.' . $voice_note->getClientOriginalExtension();
            $save_url1 = 'upload/patient/booking/' . $name_gen1;
            $voice_note->move(public_path('upload/patient/booking/'), $name_gen1);
            $visit->voice_notes = $save_url1;
            $visit->save();
        }
    }

    Notification::create([
        'title' => 'Mohamed Just Booked A Visit',
        'type' => Notification::BOOK,
        'user_id' => 1,
    ]);

    return ApiResponseTrait::apiResponse([], 'Visit Booked Successfully', Response::HTTP_OK);
}
}
