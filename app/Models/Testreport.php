<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testreport extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
