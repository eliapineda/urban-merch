@extends('layouts.app')

@section('title', 'Reviews Management')

@section('content')
<h1 class="text-3xl font-bold mb-8 uppercase tracking-widest">COMENTARIOS</h1>

<div class="flex gap-8 px-4 md:px-0">
    <div class="w-full overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100">
        <table class="w-full border-collapse min-w-[800px] md:min-w-full text-left">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-bold">
                <tr>
                    <th class="px-4 py-3 border-b">id</th>
                    <th class="px-4 py-3 border-b">autor</th>
                    <th class="px-4 py-3 border-b">producto</th>
                    <th class="px-4 py-3 border-b">comentario</th>
                    <th class="px-4 py-3 border-b text-center">rating</th>
                    <th class="px-4 py-3 border-b">fecha</th>
                    <th class="px-4 py-3 border-b text-center">eliminar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($reviews as $review)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm">{{ $review->id }}</td>
                        {{-- Accedemos a la relación 'user' --}}
                        <td class="px-4 py-3 text-sm font-bold">{{ $review->user->name ?? 'Anónimo' }}</td>
                        {{-- Accedemos a la relación 'product' --}}
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $review->product->product_name ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm italic">"{{ $review->content }}"</td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-yellow-500 font-bold">
                                {{ $review->rating }} <i class="fa-solid fa-star text-xs"></i>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $review->created_at->format('d/m/Y') }}</td>

                        <td class="px-4 py-3 text-center">
                            <form method="POST" action="{{ route('admin.reviews.delete') }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $review->id }}">
                                <button type="submit" onclick="return confirm('¿Eliminar este comentario?')" class="text-red-600 hover:text-red-800 transition">
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
@endsection
