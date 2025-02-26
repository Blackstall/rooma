<?php
// app/Models/Property.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'title',
        'type',
        'price',
        'is_price_negotiable',
        'description',
        'amenities',
        'bedrooms',
        'bathrooms',
        'furnished',
        'featured',
        'featured_until'
    ];

    protected $casts = [
        'amenities' => 'array',
        'featured_until' => 'datetime',
        'price' => 'decimal:2',
        'is_price_negotiable' => 'boolean',
        'furnished' => 'boolean',
        'featured' => 'boolean'
    ];

    // Relationships
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('featured', true)
            ->where(function ($q) {
                $q->whereNull('featured_until')
                  ->orWhere('featured_until', '>', now());
            });
    }

    public function scopeForSale($query)
    {
        return $query->where('type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('type', 'rent');
    }

    public function scopeWithFilters($query, array $filters)
    {
        return $query->when($filters['min_price'] ?? false, fn($q, $min) => 
                $q->where('price', '>=', $min)
            )
            ->when($filters['max_price'] ?? false, fn($q, $max) => 
                $q->where('price', '<=', $max)
            )
            ->when($filters['bedrooms'] ?? false, fn($q, $bedrooms) => 
                $q->where('bedrooms', '>=', $bedrooms)
            )
            ->when($filters['bathrooms'] ?? false, fn($q, $bathrooms) => 
                $q->where('bathrooms', '>=', $bathrooms)
            )
            ->when($filters['furnished'] ?? false, fn($q, $furnished) => 
                $q->where('furnished', (bool)$furnished)
            );
    }
}