<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
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
    public function associate()
    {
        return $this->belongsTo(Associate::class)->withDefault([
            'name' => 'Not Assigned',
        ]);
    }
 
}
