<?php

// app/Models/PropertyImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = ['property_id', 'image_path'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

// database/migrations/2023_01_01_000000_create_property_images_table.php
