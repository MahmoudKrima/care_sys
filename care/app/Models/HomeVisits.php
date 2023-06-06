<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeVisits extends Model
{
    use HasFactory;

    protected $guarded =[];

     public function subVisit(){
        return $this->hasMany(SubHomeVisits::class,'id','home_visit_id');
     }
}
