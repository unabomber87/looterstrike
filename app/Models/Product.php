<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category',
        'image',
        'price',
        'amazon_asin',
        'badge',
        'badge_label',
        'stars',
        'is_active',
        'sort_order',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stars' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope pour filtrer les produits actifs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accesseur pour générer automatiquement l'URL affiliée Amazon.
     */
    public function getAmazonUrlAttribute(): string
    {
        return 'https://www.amazon.com/dp/' . $this->amazon_asin . '?tag=looterstrike-20';
    }
}
