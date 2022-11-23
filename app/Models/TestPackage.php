<?php

namespace App\Models;

use App\Models\Test;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestPackage extends Model
{
    use HasFactory;
    public function test()
    {
        return $this->belongsTo('App\Models\Test')
        ->where('is_package',0);
       // return $this->belongsTo(Test::class);
       
    }
    public function package()
    {
        return $this->belongsTo(Test::class)->where('is_package',1);
    }
    public function test_packages()
    {
        return $this->hasMany(Test::class,'id','package_id')->where('is_package',1);
    }
     
    
}
