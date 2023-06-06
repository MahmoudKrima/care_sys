<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyCategory extends Model
{
    use HasFactory;

    protected $table='pharmacy_category';

    protected $guarded=[];

    public function medicine(){
        return $this->hasMany(Medicine::class,'category_id','id');
    }

}
