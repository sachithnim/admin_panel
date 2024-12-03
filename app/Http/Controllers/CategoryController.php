<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.createcategory');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $input = $request->all();

        Category::create($input);
        return redirect('/category');
    }

    public function edit($category)
    {
        $category = Category::find($category);
        return view('categories.editcategory', compact('category'));
    }

    public function update(Request $request, $category)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $input = $request->all();

        $category = Category::find($category);
        $category->name = $input['name'];

        $category->save();
        return redirect('/category');
    }

    public function destroy($category)
    {
        $category = Category::find($category);
        $category->delete();
        return redirect()->back();
    }
}
