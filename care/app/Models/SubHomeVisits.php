<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubHomeVisits extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function homeVisit(){
        return $this->hasOne(HomeVisits::class,'id','home_visit_id');
     }

}
