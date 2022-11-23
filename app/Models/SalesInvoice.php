<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    public function associate()
    {
        return $this->belongsTo('App\Models\Associate');
    }
    public function referral_doctor()
    {
        return $this->belongsTo('App\Models\ReferralDoctor');
    }
    public function lab_centre()
    {
        return $this->belongsTo('App\Models\LabCentre');
    }
    public function collection_centre()
    {
        return $this->belongsTo('App\Models\CollectionCentre');
    }
    public function discount_type()
    {
        return $this->belongsTo('App\Models\DiscountType');
    }
    public function payment_mode()
    {
        return $this->belongsTo('App\Models\PaymentMode');
    }
    public function invoice_status()
    {
        return $this->belongsTo('App\Models\InvoiceStatus');
    }
    public function created_by_user()
    {
        return $this->belongsTo('App\Models\Employee','created_by','id');
    }
    public function updated_by_user()
    {
        return $this->belongsTo('App\Models\Employee','updated_by','id');
    }
}
