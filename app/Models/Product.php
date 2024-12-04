<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = ['title', 'price', 'category_id', 'description', 'sku', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'N/A'
        ]);
    }
}
