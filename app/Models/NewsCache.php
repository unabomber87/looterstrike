<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCache extends Model
{
    /**
     * Nom de la table
     *
     * @var string
     */
    protected $table = 'news_cache';

    /**
     * Les attributs assignables en masse
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'link',
        'link_hash',
        'image',
        'excerpt',
        'author',
        'source',
        'published_at',
    ];

    /**
     * Les attributs qui doivent être castés
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'image' => 'string',
        'author' => 'string',
    ];

    /**
     * Accesseur pour 'date' (compatibilité avec la vue)
     */
    public function getDateAttribute(): string
    {
        return $this->published_at->format('Y-m-d H:i');
    }

    /**
     * Accesseur pour 'content' (utilise l'excerpt pour compatibilité avec la vue)
     */
    public function getContentAttribute(): string
    {
        return $this->excerpt;
    }

    /**
     * Convertit le modèle en tableau pour compatibilité avec la vue
     */
    public function toVueArray(): array
    {
        return [
            'title' => $this->title,
            'link' => $this->link,
            'date' => $this->date,
            'image' => $this->image,
            'content' => $this->content,
            'author' => $this->author,
            'source' => $this->source,
        ];
    }
}
