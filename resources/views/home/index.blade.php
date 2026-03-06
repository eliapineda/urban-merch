@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="relative min-h-screen flex flex-col justify-center items-center text-white px-4 bg-cover bg-center"
        style="background-image: url('{{ asset('storage/images/profile-vinil.jpg') }}');">

        <div class="btn-glass p-16 md:p-24max-w-2xl text-center">
            <h1 class="text-2xl md:text-4xl font-bold text-white uppercase tracking-wider">
                BIENVENIDO A LA TIENDA
            </h1>

            <div>
                <a href="{{ route('products.index') }}"
                    class="btn font-title text-2xl md:text-4xl font-light bg-black px-6 py-4 inline-block w-full md:w-auto">
                    ver productos
                </a>
            </div>
        </div>
    </div>
@endsection
