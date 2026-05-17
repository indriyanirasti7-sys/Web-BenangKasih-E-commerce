<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'material',
        'yarn_type',
        'yarn_weight',
        'price',
        'status',
        'stock',
        'estimated_days',
        'size',
        'colors',
        'image',
        'gallery',
        'is_featured',
        'is_active',
        'sort_order',
    ];
 
    protected $casts = [
        'colors'      => 'array',
        'gallery'     => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'price'       => 'decimal:2',
    ];
 
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
 
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
 
    public function getStatusLabelAttribute()
    {
        return $this->status === 'ready_stock' ? 'Ready Stock' : 'Pre-Order';
    }
 
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/placeholder.jpg');
    }
 
    public function getWhatsappMessageAttribute(): string
    {
        $lines = [];
        $lines[] = "Halo Kak! 👋";
        $lines[] = "Saya tertarik dengan produk berikut:";
        $lines[] = "";
        $lines[] = "🧶 *{$this->name}*";
        $lines[] = "📂 Kategori : {$this->category->name}";
        $lines[] = "💰 Harga    : {$this->formatted_price}";
        $lines[] = "📦 Status   : {$this->status_label}";

        if ($this->size) {
            $lines[] = "📏 Ukuran   : {$this->size}";
        }
        if ($this->colors) {
            $lines[] = "🎨 Warna    : " . implode(', ', $this->colors);
        }
        if ($this->status === 'pre_order' && $this->estimated_days) {
            $lines[] = "⏳ Estimasi : {$this->estimated_days} hari kerja";
        }
        if ($this->yarn_type) {
            $lines[] = "🪡 Bahan    : {$this->yarn_type}";
        }

        $lines[] = "";
        $lines[] = "🔗 Link Produk:";
        $lines[] = url('/produk/' . $this->slug);
        $lines[] = "";
        $lines[] = "Bisa info lebih lanjut untuk pemesanannya? 🙏";

        return urlencode(implode("\n", $lines));
    }
 
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
 
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
