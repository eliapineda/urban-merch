@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">Carrito de Compras</h1>

    @guest
        <div class="text-center bg-gray-50 p-10 rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-600 mb-4">Debes iniciar sesión para ver tu carrito.</p>
            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold">Iniciar Sesión</a>
        </div>
    @endguest

    @auth
        @if($cartItems->isEmpty())
            <div class="text-center py-20">
                <i class="fa-solid fa-cart-shopping text-6xl text-gray-200 mb-4"></i>
                <p class="text-center text-gray-600">Tu carrito está vacío.</p>
                <a href="{{ route('products.index') }}" class="text-indigo-600 font-bold mt-4 inline-block underline">Ir a la tienda</a>
            </div>
        @else
            <div class="flex flex-col md:flex-row gap-8">
                {{-- LISTADO DE PRODUCTOS --}}
                <div class="w-full md:w-3/5">
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($cartItems as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-6 text-left flex items-center">
                                            <div class="w-16 h-16 flex-shrink-0 mr-4">
                                                @php
                                                    $path = $item->product->mainImage?->image_path;
                                                @endphp

                                                @if($path)
                                                    <img src="{{ str_starts_with($path, 'http') ? $path : asset('storage/' . $path) }}"
                                                         alt="{{ $item->product->product_name }}"
                                                         class="w-full h-full object-cover rounded shadow-sm">
                                                @else
                                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded">
                                                        <img src="{{ asset('images/no-image.jpg') }}" alt="No Image" class="w-8 h-8 opacity-50">
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="font-bold text-gray-800">{{ $item->product->product_name }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-center font-semibold">
                                            {{ number_format($item->product->price, 2) }} €
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="bg-gray-100 px-3 py-1 rounded-full font-bold">x{{ $item->quantity }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-center font-bold text-gray-900">
                                            {{ number_format($item->product->price * $item->quantity, 2) }} €
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            {{-- Formulario para eliminar --}}
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors text-lg">
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

                {{-- RESUMEN --}}
                <div class="w-full md:w-2/5">
                    <div class="bg-gray-100 p-8 rounded-2xl shadow-sm border border-gray-200">
                        <h2 class="text-2xl font-bold mb-6">Resumen del Pedido</h2>
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-gray-600">Total a pagar:</span>
                            <span class="text-3xl font-black text-indigo-600">{{ number_format($total, 2) }} €</span>
                        </div>
                        <a href="{{ route('checkout.index') }}"
                           class="block w-full bg-black text-white text-center py-4 rounded-xl font-bold hover:bg-gray-800 transition-all active:scale-95 uppercase tracking-widest">
                            Proceder al Pago
                        </a>
                        <p class="text-center text-[10px] text-gray-400 mt-4 uppercase">Envío seguro garantizado</p>
                    </div>
                </div>
            </div>
        @endif
    @endauth
</div>
@endsection
