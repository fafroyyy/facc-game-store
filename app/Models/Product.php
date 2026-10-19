<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',  // Kolom lama untuk backward compatibility
        'images', // Kolom JSON baru
        'status', // available, sold
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Mendapatkan semua path gambar (gabungan array images dan old image)
     */
    public function getAllImages(): array
    {
        $result = [];
        if (!empty($this->images)) {
            $result = $this->images;
        } elseif (!empty($this->image)) {
            $result = [$this->image];
        }
        return $result;
    }
}
