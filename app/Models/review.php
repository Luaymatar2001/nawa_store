<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['name', 'email', 'subject', 'star', 'product_id', 'review'];
    public function product() {
        return $this->belongsTo(Product::class, "product_id");
    }
    
}
