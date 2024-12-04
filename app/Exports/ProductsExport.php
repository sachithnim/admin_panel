<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    // Store products data passed from the controller
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        // Return the collection of products
        return $this->products;
    }

    public function headings(): array
    {
        // Define the column headings
        return [
            'ID', 'Title', 'Price', 'Description', 'SKU', 'Category', 'Image'
        ];
    }
}
