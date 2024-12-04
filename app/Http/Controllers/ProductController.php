<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with('category');

    // If there's a search term, filter by title, description, or SKU
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;
        $query->where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('sku', 'like', '%' . $searchTerm . '%');
        });
    }

    // If a category is selected, filter by category_id
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    // Paginate results
    $products = $query->paginate(5);

    // Pass categories to the view for the dropdown
    $categories = Category::all();

    return view('dashboard', compact('products', 'categories'));
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


    public function export(Request $request)
    {
        // You can add filtering like in the index method
        $query = Product::with('category');

        // If there's a search term, filter by title, description, or SKU
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhere('sku', 'like', '%' . $searchTerm . '%');
            });
        }

        // If a category is selected, filter by category_id
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Get the filtered products
        $products = $query->get();

        // Return the export file as Excel (or CSV depending on the file extension)
        return Excel::download(new ProductsExport($products), 'products-report.xlsx');  // Change to .csv if needed
    }

    public function exportPdf(Request $request)
    {
        $query = Product::with('category');

        // Apply filters like search or category if present
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhere('sku', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by category if selected
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Get the filtered products
        $products = $query->get();

        // Load the view and pass the products data
        $pdf = Pdf::loadView('products.pdf_report', compact('products'));

        // Return the generated PDF as a download
        return $pdf->download('products-report.pdf');
    }
}
