<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Products';
        $products = Product::orderBy('created_at','desc')->paginate(10);

        return view('products.index')->with(compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Product';

        return view('products.add')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required:max:50',
            'product_price' => 'required:max:50',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1044',
            'product_discription' => 'required'
        ]);

        $product_image = $request->product_image;
        $product_image_new_name = time().'-'.$product_image->getClientOriginalName();
        $product_image->move('uploads/products', $product_image_new_name);

        $product = Product::create([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'image' => $product_image_new_name,
            'discription' => $request->product_discription
        ]); 

        Session::flash('success', 'Product create successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $title = 'Create Product';

        return view('products.edit')->with(compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product_name' => 'required:max:50',
            'product_price' => 'required:max:50',
            'product_discription' => 'required'
        ]);

        if ($request->hasFile('product_image')) {
            $product_image = $request->product_image;
            $product_image_new_name = time().'-'.$product_image->getClientOriginalName();
            $product_image->move('uploads/products', $product_image_new_name);
            $product->image = $product_image_new_name;
        }

        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->discription = $request->product_discription;
        $product->save();

        Session::flash('success', 'Product update successfuly!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (file_exists('uploads/products/'.$product->image)) {
            unlink('uploads/products/'.$product->image);
        }

        $product->delete();

        Session::flash('error', 'Product deleted successfuly!');
        return redirect()->route('products.index');
    }

    public function status($id)
    {
        $product = Product::find($id);
        if ($product->status == 'Available') {
            $product->status = 'Out of stock';
            $product->save();
        }else{
            $product->status = 'Available';
            $product->save();
        }

        Session::flash('success', 'Product status updated successfuly!');
        return redirect()->back();
    }
}
