<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table='medicine';

    protected $guarded=[];

    public function pharmacy(){
        return $this->hasOne(PharmacyCategory::class,'id','category_id');
    }
}
