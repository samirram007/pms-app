<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    protected $table = 'sales_orders';
    protected $fillable = [ 
    ];
    protected $hidden = [

    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
    public function sales_order_items()
    {
        return $this->hasMany('App\Models\SalesOrderItem');
    }
    
}
