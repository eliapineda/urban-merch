@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            {{-- auth()->user() nos da el objeto del usuario logueado --}}
            <h2 class="text-4xl font-bold text-[#333]">Bienvenido, {{ auth()->user()->name }}</h2>
        </div>
        <div>
            {{-- En Laravel, el logout suele ser un formulario POST por seguridad --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-glass">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <div class="text-center">
        <div class="mb-4">
            {{-- Jetstream tiene una lógica de fotos de perfil, pero aquí usamos tu estática --}}
            <img src="{{ asset('storage/images/profile.png') }}" alt="Profile Picture" class="w-32 h-32 rounded-full mx-auto shadow-lg">
        </div>

        <hr class="my-6 border-t-2 border-gray-300 w-96 mx-auto">

        <div class="w-80 mx-auto text-left">
            <div class="mb-4">
                <p class="font-semibold text-gray-600">Nombre de usuario:</p>
                <p class="input">{{ auth()->user()->name }}</p>
            </div>
            <div class="mb-4">
                <p class="font-semibold text-gray-600">Email:</p>
                <p class="input">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
