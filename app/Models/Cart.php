<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function offer(){
        return $this->hasOne(Offer::class,'id','offer_id');
    }

    public function medicine(){
        return $this->hasOne(Medicine::class,'id','medicine_id');
    }
}
