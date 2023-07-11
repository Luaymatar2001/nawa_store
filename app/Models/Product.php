<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    //mass assingment 
    protected $fillable = ['name', 'slug', 'description', 'short_description', 'price', 'compare_price', 'category_id', 'image', 'status'];
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    protected $appends = ['price_formatter', 'image_url', 'compare_price_formatter'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'uncategorized'
        ]);
    }
    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function review()
    {
        return $this->hasMany(review::class, 'product_id');
    }
    #Gloable Scope
    // protected static function booted()
    // {
    //     static::addGlobalScope('owner', function (Builder $query) {
    //         $query->where('user_id', '=', 1);
    //     });
    // }

    #local Scope
    public function scopeActive(Builder $query)
    {
        $query->where('status', '=', 'active');
    }

    public function scopeStatus(Builder $query, $status)
    {
        $query->where('status', '=', $status);
    }

    public static function status_option()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',

        ];
    }
    //Attribute Accessor
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // return Storage::disk('public')->url('string',  $this->image);
            return url('storage', [
                'image' => $this->image,
            ]);
        }
        return 'http://via.placeholder.com/80x80';
    }


    //إذا كان نفس القيمة الموجودة في الداتا بيز يتم تمريرها كأتربيوت
    //بغلب في التعامل معه في الكنترولر
    // public function getImageAttribute($value)
    // {
    //     if ($value) {
    //         return url('storage', [
    //             'image' => $value,
    //         ]);
    //     }
    //     return 'http://via.placeholder.com/80x80';
    // }

    public function getPriceFormatterAttribute()
    {
        // $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        // $formatter->formatCurrency($this->price, 'USD');
        // return $formatter;
        return number_format($this->price, 2) . "$";
    }
    public function getComparePriceFormatterAttribute()
    {
        // $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        // $formatter->formatCurrency($this->price, 'USD');
        // return $formatter;
        return number_format($this->compare_price, 2) . "$";
    }
}
