<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReportConfig extends Model
{
    use HasFactory;
    function test()
    {
        return $this->belongsTo(Test::class);
    }
    function report_test_id(){
        return $this->belongsTo(Test::class, 'report_test_id')->default(0);
    }
}
