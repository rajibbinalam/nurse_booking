<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    use HasFactory;
    public function speciality(){
    	return $this->hasone("App\Models\Speciality",'id','specialities_id');
    }
}
