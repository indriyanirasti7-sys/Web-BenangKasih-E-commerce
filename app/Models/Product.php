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
 
    public function generateWhatsappMessage($nama = '', $alamat = '', $warna = '-') : string
    {
        $lines = [];
        $lines[] = "Halo Kak! 👋";
        $lines[] = "Saya tertarik dengan produk berikut:";
        $lines[] = "";
        
        // ─── DATA UTAMA PRODUK ───
        $lines[] = "🧶 *{$this->name}*";
        
        // Mengambil icon dan nama kategori melalui relasi belongsTo
        if ($this->category) {
            $icon = $this->category->icon ?? '📂';
            $lines[] = "{$icon} Kategori : {$this->category->name}";
        }
        
        $lines[] = "💰 Harga    : {$this->formatted_price}";
        $lines[] = "📦 Status   : {$this->status_label}";

        // ─── DETAIL SPESIFIKASI PRODUK (Mengecek jika data ada) ───
        if ($this->size) {
            $lines[] = "📏 Ukuran   : {$this->size}";
        }
        
        // Menampilkan warna yang dipilih user di form (default: token underscore untuk JS .replace)
        $lines[] = "🎨 Warna    : " . ($warna ?: '-');

        // Jika statusnya Pre-Order, tampilkan estimasi pengerjaannya
        if ($this->status === 'pre_order' && $this->estimated_days) {
            $lines[] = "⏳ Estimasi : {$this->estimated_days} hari kerja";
        }

        // Menampilkan info bahan/material benang jika diisi di database
        if ($this->yarn_type) {
            $lines[] = "🪡 Bahan    : {$this->yarn_type}";
        }
        if ($this->material) {
            $lines[] = "🧵 Detail   : {$this->material}";
        }

        $lines[] = "";
        
        // ─── DATA PENGIRIMAN DOMESTIK (Menggunakan token penanda untuk diganti oleh JS) ───
        $lines[] = "📍 *Data Pengiriman Penerima:*";
        $lines[] = "👤 Nama     : " . ($nama ?: '___NAMA_PEMBELI___');
        $lines[] = "🏠 Alamat   : " . ($alamat ?: '___ALAMAT_PEMBELI___');
        $lines[] = "";
        
        // ─── LINK INFORMASI ───
        $lines[] = "🔗 Link Produk:";
        $lines[] = url('/produk/' . $this->slug);
        $lines[] = "";
        $lines[] = "Bisa info lebih lanjut untuk pemesanannya? 🙏";

        // Satukan baris array menjadi satu string teks utuh dengan enter (\n)
        return implode("\n", $lines);
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
