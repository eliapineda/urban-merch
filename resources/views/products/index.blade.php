@extends('layouts.app') @section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-4">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div class="overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <a href="{{ route('products.show', $product->id) }}" class="flex-1 flex flex-col">
                        @php
                            // 1. Obtenemos el path de la imagen principal (si existe)
                            $path = $product->mainImage?->image_path;

                            // 2. Decidimos la URL final
                            if ($path) {
                                // Si empieza por http (URL externa), la usamos tal cual
                                // Si no, generamos la URL local con asset('storage/...')
                                $finalUrl = str_starts_with($path, 'http') ? $path : asset('storage/' . $path);
                            } else {
                                // Imagen por defecto si no hay nada en la BD
                                $finalUrl = asset('storage/images/no-image.jpg');
                            }
                        @endphp
                        <img src="{{ $finalUrl }}" alt="{{ $product->product_name }}" class="w-full h-80 object-cover">
                        <div class="p-4 flex-1 flex flex-row justify-between">

                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->product_name }}</h3>
                            <p class="font-bold text-xl">{{ number_format($product->price, 2) }} €</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
