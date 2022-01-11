<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        't_name',
        't_price',
    ];

    public function petientDetailModel(){
       return $this->belongsToMany(Patient::class,'patient_tests','test_id','patient_id');
    }
}
