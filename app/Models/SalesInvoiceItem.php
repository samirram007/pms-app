<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceItem extends Model
{
    use HasFactory;
    function sales_invoice()
    {
        return $this->belongsTo('App\Models\SalesInvoice', 'sales_invoice_id');
    }
    function test()
    {
        return $this->belongsTo('App\Models\Test', 'test_id');
    }
}
