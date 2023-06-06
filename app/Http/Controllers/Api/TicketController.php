<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Response;



class TicketController extends Controller
{
    Use ApiResponseTrait;
    protected $guarded = [];
    protected $table = 'tickets';

    public function index(Request $request){
        $data=Ticket::where('patient_id',$request->patient_id)->get();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }

    public function store(Request $request){
        $request->validate([
            'problem' => ['required'],
            'attachments[]' => ['file', 'mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,jpeg,png,bmp,tiff', 'max:204800', 'sometimes'],
        ]);

        $ticket = Ticket::create([
            'code'=>'#'.rand(100000,999999),
            'problem' => $request->problem,
            'patient_id' => $request->patient_id,
            'ticket_category' => $request->ticket_category,
        ]);
        if ($request->hasFile('attachments')) {
            $attachmentPaths = [];
            foreach ($request->file('attachments') as $file) {
                
                    $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                    $filePath = 'upload/patient/ticket/' . $fileName;
                    if ($file->move(public_path('upload/patient/ticket/'), $fileName)) {
                        $attachmentPaths[] = $filePath;
                    } else {
                        return ApiResponseTrait::apiResponse([], 'Failed to move file to destination', Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
            }
            $ticket->attachments = json_encode($attachmentPaths);
            $ticket->save();
        }
        return ApiResponseTrait::apiResponse([],('Ticket Added Successfully'),200);
    }
}
