<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
    <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">Products</h3>
    @foreach ($products as $product)

        <p>{{ $product->id }}</p>
        <p>{{ $product->title }}</p>
        <p>{{ $product->price }}</p>
        
    @endforeach
</x-app-layout> 


