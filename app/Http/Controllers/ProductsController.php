<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    function generateColorFromName($name)
    {
        // Hash nama kategori untuk mendapatkan nilai unik
        $hash = crc32($name);

        // Gunakan nilai hash untuk menentukan hue (0-360)
        $hue = $hash % 360;

        // Saturation dan lightness tetap untuk warna smooth
        $saturation = 65; // 65%
        $lightness = 70;  // 70%

        // Kembalikan warna dalam format HSL
        return "hsl($hue, {$saturation}%, {$lightness}%)";
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Products()->get();
        $categories = Categories::get();
        $products = Products::get();
        
        return view("admin/product/products",[
            "categories" => $categories,
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::get();
        return view("admin/product/create_product",["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $newFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('products', $newFileName, 'public');
        }else{
            $imagePath = null;
        }

        Products::create([
            'name' => $request->name,
            'description' => $request->desc,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'product_image' => $imagePath,
        ]);

        return redirect("/dashboard-products");
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Categories::get();
        $product = Products::where("id_product", $id)->firstOrFail();
        return view("admin/product/edit_product",[
            "categories" => $categories,
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Products::where("id_product", $id)->firstOrFail();

        $imagePath = $product->product_image;
        if ($request->hasFile('img')) {
            if ($imagePath && file_exists(storage_path('app/public/' . $imagePath))) {
                unlink(storage_path('app/public/' . $imagePath));
            }

            $file = $request->file('img');
            $newFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('products', $newFileName, 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->desc,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'product_image' => $imagePath,
        ]);

        return redirect("/dashboard-products");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::where("id_product", $id)->firstOrFail();
        $product->delete();

        return redirect("/dashboard-products")->with('success', 'Product deleted successfully.');
    }
}
