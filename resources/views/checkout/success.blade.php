@extends('layouts.app') {{-- O el layout que estés usando --}}

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
    <div class="max-w-md w-full text-center bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

        <div class="mb-6 flex justify-center">
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">¡Compra con éxito!</h1>
        <p class="text-gray-600 mb-8">
            Gracias por tu confianza. Tu pedido ha sido procesado correctamente y pronto recibirás un correo con los detalles.
        </p>

        <div class="space-y-3">
            <a href="{{ url('/') }}"
               class="block w-full bg-black text-white font-semibold py-3 rounded-xl hover:bg-gray-800 transition">
                Volver a la tienda
            </a>
        </div>
    </div>
</div>
@endsection
