<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $category = Category::create($validatedData);
        return response()->json($category, 201);
//        $data = array();
//        $data['name']=$request->name;
//        DB::table('categories')->insert($data);
//        return response('done');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category->id)],
        ]);

        $category->update($validatedData);
        return response('updated')->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response('deleted');
    }
}
