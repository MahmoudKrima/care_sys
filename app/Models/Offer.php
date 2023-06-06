<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table='offers';

    protected $guarded = [];

     public function details(){
        return $this->hasOne(OfferDetails::class,'offer_id','id');
     }

    //  public function getPriceSaleAttribute(){
    //     return $this->price - $this->sale.'%';
    //  }
}
