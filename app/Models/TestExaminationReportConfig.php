<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Test;

class TestExaminationReportConfig extends Model
{
    use HasFactory;

    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
