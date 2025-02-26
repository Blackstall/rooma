<?php

// app/Models/Chat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['property_id', 'customer_id', 'agent_id', 'deal_closed'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}