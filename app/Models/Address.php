<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

// The Address model represents the addresses table in the database. The address should belong to a user.
class Address extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    // The attributes that are mass assignable.
    protected $fillable = [
        'country',
        'city',
        'post_code',
        'street',
    ];

    // The attributes that should be hidden for serialization.
    protected $hidden = [
        'user_id',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // The address belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
