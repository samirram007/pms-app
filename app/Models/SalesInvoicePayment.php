<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoicePayment extends Model
{
    use HasFactory;
    function payment_mode()
    {
        return $this->belongsTo('App\Models\PaymentMode', 'payment_mode_id');
    }
    function sales_invoice()
    {
        return $this->belongsTo('App\Models\SalesInvoice', 'sales_invoice_id');
    }
    
}
