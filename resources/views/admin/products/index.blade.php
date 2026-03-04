@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
<h1 class="text-3xl font-bold mb-8 uppercase tracking-widest">PRODUCTOS</h1>

<div class="flex flex-col md:flex-row gap-8">

    {{-- FORMULARIO (Izquierda) --}}
    <div class="w-full md:w-1/3 md:sticky md:top-6 self-start">
        {{-- Si hay editProduct, usamos la ruta update, si no, la ruta store --}}
        <form method="POST"
              action="{{ $editProduct ? route('admin.products.update', $editProduct->id) : route('admin.products.store') }}"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

            @csrf
            @if($editProduct) @method('PUT') @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Nombre:</label>
                    <input type="text" name="product_name" class="w-full border-gray-300 rounded-lg p-2"
                        value="{{ old('product_name', $editProduct->product_name ?? '') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Descripción:</label>
                    <textarea name="description" class="w-full border-gray-300 rounded-lg p-2 max-h-64">{{ old('description', $editProduct->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Precio (€):</label>
                    <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded-lg p-2"
                        value="{{ old('price', $editProduct->price ?? '') }}">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Imágenes del Producto:</label>
                    <input type="file" name="images[]" id="imageInput" class="w-full border border-dashed p-2" multiple accept="image/*">
                    <small class="text-gray-400">Puedes seleccionar varias imágenes.</small>

                    <div id="previewContainer" class="flex flex-wrap gap-4 mt-4 p-4 border-2 border-dashed border-gray-200 rounded-lg">
                        @if(!empty($productImages) && count($productImages) > 0)
                            @foreach($productImages as $img)
                                <div class="preview-item relative w-20 h-20 border rounded overflow-hidden shadow-sm">
                                    <img src="{{ str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path) }}"
                                         class="w-full h-full object-cover">
                                    @if($img->is_main)
                                        <span class="absolute top-0 right-0 bg-red-600 text-white text-[10px] px-1 font-bold">Main</span>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p id="placeholderText" class="text-gray-400 text-sm w-full text-center italic">No hay imágenes actuales</p>
                        @endif
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg font-bold hover:bg-gray-800 transition">
                    {{ $editProduct ? 'ACTUALIZAR' : 'GUARDAR PRODUCTO' }}
                </button>

                @if($editProduct)
                    <a href="{{ route('admin.products') }}" class="block text-center text-sm text-gray-500 mt-2">Cancelar edición</a>
                @endif
            </div>
        </form>
    </div>

    {{-- TABLA (Derecha) --}}
    <div class="w-full md:w-2/3">
        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-4 py-3 border-b">id</th>
                        <th class="px-4 py-3 border-b">name</th>
                        <th class="px-4 py-3 border-b">description</th>
                        <th class="px-4 py-3 border-b">precio</th>
                        <th class="px-4 py-3 border-b">imagenes</th>
                        <th class="px-4 py-3 border-b text-center">acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm">{{ $product->id }}</td>
                            <td class="px-4 py-3 text-sm font-bold">{{ $product->product_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500 truncate max-w-[150px]">{{ $product->description }}</td>
                            <td class="px-4 py-3 text-sm">{{ $product->price }}€</td>
                            <td class="px-4 py-3">
                                @if($product->mainImage)
                                    <img src="{{ str_starts_with($product->mainImage->image_path, 'http') ? $product->mainImage->image_path : asset('storage/' . $product->mainImage->image_path) }}"
                                         class="w-10 h-10 object-cover rounded shadow-sm">
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-3 text-lg">
                                {{-- Editar: Recarga la página con ?edit=ID --}}
                                <a href="{{ route('admin.products', ['edit' => $product->id]) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- Borrar: Formulario pequeño para DELETE --}}
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar producto?')" class="text-red-600 hover:text-red-800">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Tu script de preview se mantiene igual de funcional
    document.getElementById('imageInput').addEventListener('change', function (event) {
        const container = document.getElementById('previewContainer');
        const placeholder = document.getElementById('placeholderText');
        container.querySelectorAll('.preview-item').forEach(el => el.remove());
        const files = event.target.files;
        if (files.length > 0) {
            if(placeholder) placeholder.style.display = 'none';
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item relative w-20 h-20 border rounded overflow-hidden bg-gray-100 shadow-sm';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 bg-black bg-opacity-50 w-full text-[10px] text-white text-center py-1 font-bold">Nuevo</div>`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    });
</script>
@endsection
