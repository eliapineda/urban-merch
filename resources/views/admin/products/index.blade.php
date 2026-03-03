@extends('layouts.app')

@section('title', 'Administración de Productos')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 uppercase">Panel de Inventario</h1>
            <a href="{{ route('admin.products.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-bold transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Nuevo Producto
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4">Imagen</th>
                        <th class="px-6 py-4">Nombre</th>
                        <th class="px-6 py-4">Precio</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                @php $path = $product->mainImage?->image_path; @endphp
                                <img src="{{ $path ? (str_starts_with($path, 'http') ? $path : asset('storage/' . $path)) : asset('images/no-image.jpg') }}"
                                    class="w-12 h-12 object-cover rounded-md shadow-sm">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $product->product_name }}
                            </td>
                            <td class="px-6 py-4 text-indigo-600 font-bold">
                                {{ number_format($product->price, 2) }} €
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    {{-- Botón Editar --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    {{-- Botón Eliminar (Usando tu lógica de modal) --}}
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-full transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
