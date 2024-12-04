<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('dashboard', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|string|min:3|max:50',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10|max:255',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
        ]);

        $input = $request->all();
        if ($request->hasFile('image'))
        {
            $destinationPath = 'public/images/products';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destinationPath, $image_name);

            $input['image'] = $image_name;

        }
        
        Product::create($input);
        session()->flash('message', $input['title'] . ' product successfully saved');
        
        return redirect('/dashboard');
    }

    public function edit($product)
    {
        $categories = Category::all();
        $product = Product::find($product);
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $product)
    {

        $request->validate([
            'title' => 'required|string|min:3|max:50',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product, 
            'category_id' => 'required|exists:categories,id',
        ]);

        $input = $request->all();

        $product = Product::find($product);
        $product->title = $input['title'];
        $product->price = $input['price'];
        $product->description = $input['description'];
        $product->sku = $input['sku'];
        $product->category_id = $input['category_id'];

        $product->save();
        session()->flash('message', $input['title'] . ' product successfully updated');
        return redirect('/dashboard');
    }

    public function destroy($product)
    {
        $product = Product::find($product);
        $product->delete();
        session()->flash('message','Product successfully deleted');
        return redirect()->back();
    }
}
