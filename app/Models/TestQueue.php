<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQueue extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    public function test()
    {
        return $this->belongsTo('App\Models\Test');
    }
    public function sales_invoice()
    {
        return $this->belongsTo('App\Models\SalesInvoice');
    }
    public function lab_centre()
    {
        return $this->belongsTo('App\Models\LabCentre');
    }
    public function collection_centre()
    {
        return $this->belongsTo('App\Models\CollectionCentre');
    }

    public function test_package()
    {
        return $this->belongsTo('App\Models\Test','package_id','id')->withDefault();
    }


}
