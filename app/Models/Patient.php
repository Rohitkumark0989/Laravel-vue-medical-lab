<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'p_name',
        'p_mobile',
        'p_age',
        'p_gender',
        'p_cnic',
        'p_address',
        'p_subtotal',
        'p_discount',
        'p_total',
    ];

    public function testDetails(){
        return $this->belongsToMany(Test::class,'patient_tests','patient_id','test_id'); 
    }
}
