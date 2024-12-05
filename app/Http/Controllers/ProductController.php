<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
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

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|min:3|max:50',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string|min:10|max:255',
        'sku' => 'required|string|unique:products,sku',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'  // Optional image validation
    ]);

    // Log the request data before processing
    Log::info('Received request to add product', [
        'title' => $request->input('title'),
        'price' => $request->input('price'),
        'sku' => $request->input('sku'),
        'category_id' => $request->input('category_id'),
        'has_image' => $request->hasFile('image')
    ]);

    $input = $request->all();

    // Check if the image is uploaded
    if ($request->hasFile('image')) {
        $destinationPath = 'images/products';
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $path = $request->file('image')->storeAs($destinationPath, $image_name);

        $input['image'] = $image_name;

        // Log image upload success
        Log::info('Image uploaded successfully', [
            'image_name' => $image_name,
            'path' => $path
        ]);
    } else {
        $input['image'] = null;  // Set image to null if no file is uploaded

        // Log the absence of an image
        Log::info('No image uploaded for product', [
            'title' => $input['title']
        ]);
    }

    // Create the product in the database
    Product::create($input);

    // Log product creation success
    Log::info('Product successfully created', [
        'title' => $input['title'],
        'sku' => $input['sku'],
        'category_id' => $input['category_id']
    ]);

    // Flash a message and redirect
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
    // Log the start of the update process
    Log::info("Updating product with ID: $product");
    
    // Validate the input fields
    $request->validate([
        'title' => 'required|string|min:3|max:50',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string|min:10|max:255',
        'sku' => 'required|string|unique:products,sku,' . $product, 
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validate the image if provided
    ]);
    Log::info("Validation passed for product ID: $product");
    
    // Get the input data
    $input = $request->all();
    
    // Find the product
    $product = Product::find($product);
    
    if (!$product) {
        Log::error("Product with ID $product not found");
        return redirect('/dashboard')->withErrors('Product not found!');
    }
    
    Log::info("Product found: $product->title");
    
    // Update the product details
    $product->title = $input['title'];
    $product->price = $input['price'];
    $product->description = $input['description'];
    $product->sku = $input['sku'];
    $product->category_id = $input['category_id'];
    Log::info("Product details updated for: $product->title");
    
    // Check if a new image is uploaded
    if ($request->hasFile('image')) {
        // Log image upload
        Log::info("New image uploaded for product ID: $product->id");

        // Delete the old image if it exists
        if ($product->image && file_exists(storage_path('images/products/' . $product->image))) {
            // Delete the old image from the public directory
            unlink(storage_path('images/products/' . $product->image));
            Log::info("Old image deleted for product ID: $product->id");
        }

        // Store the new image
        $image = $request->file('image');
        $image_name = time() . '_' . $image->getClientOriginalName();  // Generate a unique name for the image
        $path = $image->storeAs('images/products', $image_name);  // Save the image to the public disk
        
        // Update the image field in the database
        $product->image = $image_name;
        Log::info("Image updated for product ID: $product->id, new image name:  $path ,$image_name");
    }

    // Save the updated product
    $product->save();
    
    // Log the success
    Log::info("Product ID: $product->id successfully updated");
    
    // Flash a success message
    session()->flash('message', $input['title'] . ' product successfully updated');
    
    // Redirect back to the dashboard
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
