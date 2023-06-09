<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitBook extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function patient(){
        return $this->hasOne(User::class,'id','patient_id');
    }
    public function subVisit(){
        return $this->hasOne(Service::class,'id','service_id');
    }

}
