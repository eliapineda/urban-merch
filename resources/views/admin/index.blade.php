@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
<div class="max-w-7xl mx-auto py-10">
    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 px-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 text-center md:text-left uppercase tracking-tight">
                Panel de Administración
            </h1>
        </div>
    </div>

    <div class="flex justify-center p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-4 md:mt-8 text-center">

            <a href="{{ route('admin.products') }}"
                class="w-full md:w-64 min-h-48 bg-secondary rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 p-6 flex items-center justify-center text-center text-3xl font-bold text-white uppercase font-title">
                PRODUCTOS
            </a>

            <a href="{{ route('admin.users') }}"
                class="w-full md:w-64 min-h-48 bg-secondary rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 p-6 flex items-center justify-center text-center text-3xl font-bold text-white uppercase font-title">
                USUARIOS
            </a>

            <a href="{{ route('admin.reviews') }}"
                class="w-full md:w-64 min-h-48 bg-secondary rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 p-6 flex items-center justify-center text-center text-3xl font-bold text-white uppercase font-title">
                COMENTARIOS
            </a>

        </div>
    </div>
</div>
@endsection
