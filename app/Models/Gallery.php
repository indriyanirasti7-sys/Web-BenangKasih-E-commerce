<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
     use HasFactory;

    protected $fillable = [
        'product_id', 'image', 'caption', 'alt',
        'sort_order', 'is_featured',
    ];

    protected $casts = ['is_featured' => 'boolean'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }
}
