<?php

namespace App\Models;

use App\Models\TestPackage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Console\Migrations\RefreshCommand;

class Test extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'tests';

    public function test_group()
    {
        return $this->belongsTo('App\Models\TestGroup')->withDefault();
    }
    public function test_category()
    {
        return $this->belongsTo('App\Models\TestCategory')->withDefault();
    }
    public function test_unit()
    {
        return $this->belongsTo('App\Models\TestUnit')->withDefault();
    }
    public function test_package()
    {
        return $this->belongsTo('App\Models\TestPackage','package_id','id')->withDefault();
    }
   
  
}
