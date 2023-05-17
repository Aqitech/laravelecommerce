<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {
        $title = 'Shop';
        $products = Product::orderBy('created_at','desc')->paginate(3);

        return view('frontend.index')->with(compact('title','products'));
    }

    public function single($id)
    {
        $product = Product::find($id);
        $title = $product->name;

        return view('frontend.single')->with(compact('title','product'));
    }
}
