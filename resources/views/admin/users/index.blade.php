@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<h1 class="text-3xl font-bold mb-8 uppercase tracking-widest">USUARIOS</h1>

<div class="flex flex-col md:flex-row gap-8">

    {{-- FORMULARIO (Izquierda) --}}
    <div class="w-full md:w-1/3 md:sticky md:top-6 self-start">
        <form method="POST" action="{{ route('admin.users.save') }}"
              class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

            @csrf
            {{-- Campo oculto para el ID si estamos editando --}}
            <input type="hidden" name="id" value="{{ $editUser->id ?? '' }}">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Username:</label>
                    <input type="text" name="username" class="w-full border-gray-300 rounded-lg p-2"
                        value="{{ old('username', $editUser->name ?? '') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Email:</label>
                    <input type="email" name="email" class="w-full border-gray-300 rounded-lg p-2"
                        value="{{ old('email', $editUser->email ?? '') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Rol:</label>
                    <select name="role" class="w-full border-gray-300 rounded-lg p-2">
                        <option value="user" {{ (isset($editUser) && $editUser->role == 'user') ? 'selected' : '' }}>Usuario</option>
                        <option value="admin" {{ (isset($editUser) && $editUser->role == 'admin') ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 uppercase">Password:</label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded-lg p-2"
                           placeholder="{{ $editUser ? 'Dejar en blanco para no cambiar' : 'Mínimo 8 caracteres' }}">
                </div>

                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg font-bold hover:bg-gray-800 transition">
                    {{ $editUser ? 'ACTUALIZAR USUARIO' : 'CREAR USUARIO' }}
                </button>

                @if($editUser)
                    <a href="{{ route('admin.users') }}" class="block text-center text-sm text-gray-500 mt-2">Cancelar edición</a>
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
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Nombre</th>
                        <th class="px-4 py-3 border-b">Email</th>
                        <th class="px-4 py-3 border-b">Rol</th>
                        <th class="px-4 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-sm font-bold">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm uppercase">
                                <span class="px-2 py-1 rounded text-[10px] {{ $user->role == 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-3 text-lg">
                                <a href="{{ route('admin.users', ['edit' => $user->id]) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.users.delete') }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" onclick="return confirm('¿Eliminar usuario?')" class="text-red-600 hover:text-red-800">
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
@endsection
