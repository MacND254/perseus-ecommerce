<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch trending products or a selection of products
        $products = Product::where('is_active', 1)
            ->orderBy('created_at', 'desc') // Or any condition to define "trending"
            ->take(8) // Limit the number of products displayed
            ->get();
           // dd($products->pluck('image_url', 'name'));

        return view('home', compact('home.index'));
    }
}
