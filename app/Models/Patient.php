<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Patient extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard='patient';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'code',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
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
