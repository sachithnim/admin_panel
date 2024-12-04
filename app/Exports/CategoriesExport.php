<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Category::query();

        // If there's a search term, filter by name or description
        if ($this->request->has('search') && $this->request->search != '') {
            $searchTerm = $this->request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Return the data for Excel
        return $query->get(['id', 'name', 'description', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Date Created',
        ];
    }
}
