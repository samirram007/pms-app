<?php

namespace App\Models;

use App\Models\Test;
use App\Models\TestPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    public function test_package()
    {
        return $this->hasMany(TestPackage::class,'package_id','id');
    }
     
   
    
}
