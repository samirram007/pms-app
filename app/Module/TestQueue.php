<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQueue extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function lab_centre()
    {
        return $this->belongsTo(LabCentre::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function sales_invoice()
    {
        return $this->belongsTo(SalesInvoice::class);
    }
}
