<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionCentre extends Model
{
    use HasFactory;
    public function lab_centre()
    {
        return $this->belongsTo(LabCentre::class);
    }
}
