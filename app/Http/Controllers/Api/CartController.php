<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    Use ApiResponseTrait;

    public function add(Request $request){
        Cart::create([
            'patient_id' => $request->patient_id,
            'medicine_id' => $request->medicine_id,
            'offer_id' => $request->offer_id,
        ]);
        return ApiResponseTrait::apiResponse([],('Insert Data Successfully'),200);
    }

    public function index(Request $request)
    {
        $data = User::where('id', $request->id)
            ->with(['cart.offer' => function ($query) {
                $query->select('id', 'title_' . app()->getLocale(), 'image_' . app()->getLocale(), 'price', 'sale', 'stock', 'type_' . app()->getLocale(), 'type_description_' . app()->getLocale(), 'brand_' . app()->getLocale(), 'age_' . app()->getLocale(), 'status');
            }, 'cart.medicine:title_' . app()->getLocale()])
            ->first();
    
        $cart = $data->cart;
        $pricesAfterSale = [];
        $totalPriceAfterSale = 0;
    
        foreach ($cart as $item) {
            if ($item->offer) {
                $price = $item->offer->price;
                $sale = $item->offer->sale;
                $priceAfterSale = $price - ($price * $sale / 100);
                $pricesAfterSale[] = $priceAfterSale;
                $totalPriceAfterSale += $priceAfterSale;
            } elseif ($item->medicine) {
                $price = $item->medicine->price;
                $sale = $item->medicine->sale;
                $priceAfterSale = $price - ($price * $sale / 100);
                $pricesAfterSale[] = $priceAfterSale;
                $totalPriceAfterSale += $priceAfterSale;
            }
        }
    
        $data->totalPriceAfterSale = $totalPriceAfterSale;
    
        return ApiResponseTrait::apiResponse($data, 'Get All Data Successfully', 200);
    }
    


    public function checkout(Request $request){
        $current = Carbon::now();
        $estimated_time = $current->addDays(1);
        $data=Order::create([
            'code'=>'#'.rand(100000,999999),
            'patient_id'=>$request->patient_id,
            'total'=>$request->total,
            'estimated_time'=>$estimated_time,
            'order_placed'=> $current,
        ]);
        return ApiResponseTrait::apiResponse($data,('Insert Data Successfully'),200);
    }

    public function trackOrder(Request $request){
        $data=Order::where('code',$request->code)->first();
        return ApiResponseTrait::apiResponse($data,('Get Data Successfully'),200);
    }
}
