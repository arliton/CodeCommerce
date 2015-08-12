<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'featured',
        'recommended'
    ];

    public function category()
    {
        return $this->belongsTo('CodeCommerce\Category');
    }

    public function images()
    {
        return $this->hasMany('CodeCommerce\ProductImage');
    }

    public function tags()
    {
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', '=', 1)
            ->orWhere('featured', '=', "on");
    }

    public function scopeRecommended($query)
    {
        return $query->where('recommended', '=', 1)
            ->orWhere('recommended', '=', "on");
    }

}
