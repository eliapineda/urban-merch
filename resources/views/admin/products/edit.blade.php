@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-8">Editar Producto: {{ $product->product_name }}</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border">
        @csrf
        @method('PUT') {{-- Obligatorio para rutas de actualización en Laravel --}}

        <div class="grid grid-cols-1 gap-6">
            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Precio --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Precio (€)</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Imágenes Actuales --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Imágenes Actuales</label>
                <div class="flex gap-4 mb-4 overflow-x-auto p-2 bg-gray-50 rounded-lg">
                    @foreach($product->images as $img)
                        <div class="relative w-20 h-20 flex-shrink-0">
                            <img src="{{ str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path) }}"
                                 class="w-full h-full object-cover rounded border">
                        </div>
                    @endforeach
                </div>

                <label class="block text-sm font-medium text-gray-700">Añadir más imágenes</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('admin.products') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition">
                Actualizar Producto
            </button>
        </div>
    </form>
</div>
@endsection
