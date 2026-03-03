@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="relative min-h-screen flex flex-col justify-center items-center text-white px-4 bg-cover bg-center"
     style="background-image: url('{{ asset('images/profile-vinil.jpg') }}');">

    <div class="absolute inset-0 bg-black/30"></div>

    <div class="relative z-10 btn-glass p-8 md:p-24 w-full max-w-2xl text-center backdrop-blur-sm border border-white/20 rounded-2xl shadow-2xl">
        <h1 class="text-2xl md:text-4xl font-bold text-white uppercase tracking-widest mb-8">
            BIENVENIDO A LA TIENDA
        </h1>

        <div class="bg-red-600/50 p-6 rounded-lg mt-6 md:mt-4 text-center">
            <a href="{{ route('products.index') }}"
               class="inline-block w-full md:w-auto bg-black text-white font-light text-2xl md:text-4xl py-4 px-10 uppercase tracking-tighter hover:bg-gray-900 transition-all active:scale-95 shadow-lg">
                ver productos
            </a>
        </div>
    </div>
</div>
@endsection
