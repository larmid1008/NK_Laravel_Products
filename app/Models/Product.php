<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        "title",
        "description",
        "price",
        "image_url",
        "published_at",
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "category_products");
    }
}
