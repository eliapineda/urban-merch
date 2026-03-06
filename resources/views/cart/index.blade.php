@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-10 uppercase tracking-widest">Carrito de Compras</h1>

        @guest {{-- Se muestra si NO ha iniciado sesión --}}
            <p class="text-center text-gray-600">Debes <a href="/login" class="font-bold">iniciar sesión</a> para ver tu carrito.</p>
        @endguest

        @auth {{-- Se muestra si SÍ ha iniciado sesión --}}
            @if ($cartItems->isEmpty())
                <div class="text-center py-20">
                    <p class="text-xl text-gray-600">Tu carrito está vacío.</p>
                    <a href="{{ route('products.index') }}" class="text-blue-600 underline mt-4 inline-block">Volver a la
                        tienda</a>
                </div>
            @else
                <div class="flex flex-col md:flex-row gap-8">
                    {{-- LISTA DE PRODUCTOS --}}
                    <div class="w-full md:w-3/5">
                        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100">
                            <table class="w-full text-left">
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($cartItems as $item)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="py-4 px-6 flex items-center">
                                                @if ($item->product->mainImage)
                                                    <img src="{{ asset('storage/' . $item->product->mainImage->image_path) }}"
                                                        alt="{{ $item->product->product_name }}"
                                                        class="w-20 h-20 object-cover rounded-lg mr-4 shadow-sm">
                                                @else
                                                    <div
                                                        class="w-20 h-20 bg-gray-100 rounded-lg mr-4 flex items-center justify-center">
                                                        <i class="fa-solid fa-image text-gray-300"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-bold text-gray-800">{{ $item->product->product_name }}</p>
                                                    <p class="text-sm text-gray-500">{{ number_format($item->price, 2) }} €</p>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-gray-600">
                                                x {{ $item->quantity }}
                                            </td>
                                            <td class="py-4 px-6 font-bold text-gray-800">
                                                {{ number_format($item->price * $item->quantity, 2) }} €
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <form action="{{ route('cart.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
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
                        <div class="bg-gray-900 p-8 rounded-2xl shadow-xl text-white">
                            <h2 class="text-2xl font-bold mb-6 uppercase">Resumen del Pedido</h2>
                            <div class="flex justify-between mb-6 text-xl">
                                <span>Total:</span>
                                <span class="font-bold">{{ number_format($total, 2) }} €</span>
                            </div>
                            <a href="/checkout"
                                class="block w-full bg-white text-black text-center py-4 rounded-xl font-bold hover:bg-gray-200 transition">
                                PROCEDER AL PAGO
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
@endsection
