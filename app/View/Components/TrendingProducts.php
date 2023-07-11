<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrendingProducts extends Component
{
    /**
     * Create a new component instance.
     */
    public $products;
    public $title;
    public $count;
    public function __construct($title = "Trending Product", $count = 10)
    {
        $this->title = $title;
        $this->count = $count;
        $this->products = Product::with('category')
            ->active()
            ->latest('updated_at')
            // return just 8 element === limit(8)
            ->take($count)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trending-products');
    }
}
