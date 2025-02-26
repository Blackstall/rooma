<?php
// app/Models/Agent.php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'company',
        'phone',
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}