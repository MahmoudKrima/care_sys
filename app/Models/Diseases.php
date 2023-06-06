<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diseases extends Model
{
    use HasFactory;
    protected $table='disease';

    protected $guarded=[];


    public function specialist(){
        return $this->hasOne(Specialization::class,'id','specialist_id');
    }
}
