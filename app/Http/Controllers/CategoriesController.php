<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::get();
        return view('admin.category.categories',["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categories::create(['name' => $request->name]);
        return redirect('/dashboard-categories')->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($name_category)
    {
        $category = Categories::where("name", $name_category)->firstOrFail();
        
        return view('admin.category.edit_category',["category" =>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_category)
    {
        $category = Categories::where('id_category', $id_category)->firstOrFail();
        // $category = Categories::findOrFail($id_category);
        $category->name = $request->input("name");
        $category->save();

        return redirect('/dashboard-categories')->with('success', 'Category updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_category)
    {
        $category = Categories::where('id_category', $id_category)->firstOrFail();
        $category->delete();

        return redirect('/dashboard-categories')->with('success', 'Category deleted successfully.');
    }
}
