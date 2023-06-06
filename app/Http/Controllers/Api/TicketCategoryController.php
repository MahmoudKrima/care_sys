<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;


class TicketCategoryController extends Controller
{
    Use ApiResponseTrait;
    protected $guarded = [];
    protected $table = 'ticket_categories';

    public function index(){
        $data=TicketCategory::all();
        return ApiResponseTrait::apiResponse($data,('Get All Data Successfully'),200);
    }


}
