<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;
use Whoops\Exception\Formatter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    //mass assingment 
    protected $fillable = ['name', 'slug', 'description', 'short_description', 'price', 'compare_price', 'category_id', 'image', 'status'];
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    protected $appends = ['price_formatter'];
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
}
