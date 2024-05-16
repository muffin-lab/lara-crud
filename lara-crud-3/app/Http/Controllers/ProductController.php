<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller

{
    public function index()
    {
        $products = Product::orderBy("created_at", "DESC")->get();
        return view("products.list", ["products" => $products]);
    }

    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $rules = [
            "name" => "required|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric",
        ];

        if ($request->image != 'image') {
            $rules['image'] = 'image';
        }

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validate);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->image = $request->image;
        // $product->save();

        if ($request->image != 'image') {
            // image storage
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension; //unique name for image

            // save image in product directory
            $image->move(public_path('uploads/products'), $imageName);

            // save image in database
            $product->image = $imageName;
            $product->save();
        }


        return redirect()->route('products.index')->with('success', 'The product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $rules = [
            "name" => "required|min:5",
            "sku" => "required|min:3",
            "price" => "required|numeric",
        ];

        if ($request->image != 'image') {
            $rules['image'] = 'image';
        }

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validate);
        }

        // update product
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->image = $request->image;
        $product->save();

        if ($request->image != 'image') {

            // delete old image
            File::delete(public_path('uploads/products/' . $product->image));


            // image storage
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension; //unique name for image

            // save image in product directory
            $image->move(public_path('uploads/products'), $imageName);

            // save image in database
            $product->image = $imageName;
            $product->save();
        }


        return redirect()->route('products.index')->with('update', 'The product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        //delete image
        File::delete(public_path('uploads/products/' . $product->image));

        // product delete
        $product->delete();

        return redirect()->route('products.index')->with('delete', 'The product deleted successfully.');
    }
}
