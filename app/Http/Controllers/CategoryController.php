<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // If there's a search term, filter by name or description
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $categories = $query->paginate(5); // Paginate the results

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.createcategory');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string|max:500',
        ]);

        $input = $request->all();

        Category::create($input);
        session()->flash('message', $input['name'] . ' category successfully saved');
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
            'name' => 'required|string|max:255|unique:categories,name,' . $category,
            'description' => 'required|string|max:500',
        ]);

        $input = $request->all();

        $category = Category::find($category);
        $category->name = $input['name'];
        $category->description = $input['description'];

        $category->save();
        session()->flash('message', $input['name'] . ' category successfully updated');
        return redirect('/category');
    }

    public function destroy($category)
    {
        $category = Category::find($category);
        $category->delete();
        session()->flash('message','Category successfully deleted');
        return redirect()->back();
    }
}
