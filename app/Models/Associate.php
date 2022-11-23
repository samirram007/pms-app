<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    use HasFactory;
    public function lab_centre()
    {
        return $this->belongsTo(LabCentre::class);
    }
    public function collection_centre()
    {
        return $this->belongsTo(CollectionCentre::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class)->withDefault([
            'name' => 'Not Assigned',
        ]);
    }
}
