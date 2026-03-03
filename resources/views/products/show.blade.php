@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row h-full min-h-96 max-w-6xl mx-auto justify-center gap-8 p-4 m-auto mt-10 md:mt-32 mb-20 md:mb-48">

    {{-- 1. SECCIÓN DE IMÁGENES (CARRUSEL) --}}
    <div class="max-w-xl w-full md:w-3/5 mx-auto flex justify-center items-center">
        <div class="relative w-full md:w-4/5 overflow-hidden rounded-lg shadow-xl shadow-black/30 bg-gray-100">
            @if($product->images->isEmpty())
                <img src="{{ asset('images/no-image.jpg') }}" class="w-full flex-shrink-0 object-cover h-64">
            @else
                <div id="carousel" class="flex transition-transform duration-500">
                    @foreach ($product->images as $img)
                        <img src="{{ str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path) }}"
                             class="w-full flex-shrink-0 object-cover h-72 md:h-96"
                             alt="{{ $product->product_name }}">
                    @endforeach
                </div>

                @if($product->images->count() > 1)
                    <button id="prev" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2 shadow z-10">
                        &#8592;
                    </button>
                    <button id="next" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2 shadow z-10">
                        &#8594;
                    </button>
                @endif
            @endif
        </div>
    </div>

    {{-- 2. DETALLES DEL PRODUCTO --}}
    <div class="w-full md:w-2/5 px-4 md:px-0">
        <h2 class="text-3xl md:text-4xl font-bold uppercase">{{ $product->product_name }}</h2>
        <p class="font-normal mt-4 text-gray-600">{{ $product->description }}</p>
        <p class="font-bold text-3xl mt-4 text-indigo-600">
            {{ number_format($product->price, 2) }} €
        </p>

        <div class="flex items-center mt-8 gap-4">
            {{-- Formulario de Carrito con CSRF --}}
            <form id="cart-form" method="POST" action="{{ route('cart.add') }}" class="flex flex-col sm:flex-row items-center gap-3 w-full">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden bg-white h-12 w-full sm:w-auto sm:min-w-[140px] flex-shrink-0 justify-between">
                    <button type="button" id="btn-minus" class="px-4 py-2 hover:bg-gray-100 transition-colors text-gray-600 font-bold text-xl">-</button>
                    <input type="number" name="quantity" id="quantity-input" value="1" min="1" max="99" readonly
                           class="w-12 text-center font-bold text-gray-800 focus:outline-none bg-transparent">
                    <button type="button" id="btn-plus" class="px-4 py-2 hover:bg-gray-100 transition-colors text-gray-600 font-bold text-xl">+</button>
                </div>

                <button type="submit" class="w-full sm:flex-1 h-12 bg-black text-white px-6 rounded-xl font-bold hover:bg-gray-800 transition-all active:scale-95 flex items-center justify-center gap-2 uppercase tracking-wider">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Añadir al Carrito</span>
                </button>
            </form>
        </div>
    </div>
</div>

<hr class="border-gray-100 my-10">

{{-- 3. PRODUCTOS RELACIONADOS --}}
<section class="max-w-6xl mx-auto px-4 mb-20">
    <h2 class="text-3xl font-bold text-center mb-2">TE PUEDE INTERESAR</h2>
    <div class="w-24 h-1 bg-indigo-600 mx-auto mb-10"></div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        @foreach ($relatedProducts as $related)
            <div class="group">
                <a href="{{ route('products.show', $related->id) }}" class="block">
                    <div class="overflow-hidden rounded-lg bg-gray-100 mb-3">
                        @php $relPath = $related->mainImage?->image_path; @endphp
                        <img src="{{ $relPath ? (str_starts_with($relPath, 'http') ? $relPath : asset('storage/' . $relPath)) : asset('images/no-image.jpg') }}"
                             alt="{{ $related->product_name }}"
                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="flex justify-between items-start">
                        <h3 class="text-sm font-medium text-gray-700">{{ $related->product_name }}</h3>
                        <p class="font-bold text-gray-900 text-right">{{ number_format($related->price, 2) }} €</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>

{{-- 4. SECCIÓN DE OPINIONES --}}
<section class="bg-gray-50 py-16 px-4">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-10 uppercase tracking-widest">Opiniones de la comunidad</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            {{-- Columna: Dejar Review --}}
            <div class="md:col-span-1">
                @auth
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h4 class="font-bold mb-4">Danos tu opinión</h4>
                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="rating" id="rating-value" value="0">

                            <div>
                                <label class="text-sm text-gray-500 mb-2 block">Puntuación</label>
                                <div id="star-rating" class="flex gap-1 cursor-pointer">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star text-2xl text-gray-200 star-item transition-colors" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                            </div>

                            <textarea name="content" class="w-full border border-gray-200 p-3 rounded-lg min-h-[100px] text-sm focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="¿Qué te ha parecido el producto?" required></textarea>

                            <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition">
                                Publicar reseña
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 text-center">
                        <p class="text-gray-600 mb-4">Únete a la comunidad para dejar tu reseña.</p>
                        <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-full font-bold text-sm">Iniciar Sesión</a>
                    </div>
                @endauth
            </div>

            {{-- Columna: Lista de Reviews --}}
            <div class="md:col-span-2 space-y-4">
                @forelse ($product->reviews as $review)
                    <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-gray-900">@ {{ $review->user->name }}</p>
                                <p class="text-[10px] text-gray-400 font-semibold uppercase">{{ $review->created_at->format('d M, Y') }}</p>
                            </div>
                            <div class="flex text-xs text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm italic">"{{ $review->content }}"</p>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <i class="fa-solid fa-comments text-gray-200 text-5xl mb-4"></i>
                        <p class="text-gray-400 italic">Este producto aún no tiene reseñas. ¡Sé el primero!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- CARRUSEL ---
        const carousel = document.getElementById('carousel');
        if (carousel) {
            const images = carousel.children;
            const total = images.length;
            let index = 0;
            document.getElementById('next')?.addEventListener('click', () => {
                index = (index + 1) % total;
                carousel.style.transform = `translateX(-${index * 100}%)`;
            });
            document.getElementById('prev')?.addEventListener('click', () => {
                index = (index - 1 + total) % total;
                carousel.style.transform = `translateX(-${index * 100}%)`;
            });
        }

        // --- ESTRELLAS (Usando FontAwesome) ---
        const stars = document.querySelectorAll(".star-item");
        const ratingInput = document.getElementById("rating-value");
        if (stars.length) {
            stars.forEach(star => {
                star.addEventListener("click", () => {
                    const val = star.dataset.value;
                    ratingInput.value = val;
                    stars.forEach(s => {
                        if(s.dataset.value <= val) {
                            s.classList.replace('text-gray-200', 'text-yellow-400');
                        } else {
                            s.classList.replace('text-yellow-400', 'text-gray-200');
                        }
                    });
                });
            });
        }

        // --- CANTIDAD ---
        const quantityInput = document.getElementById('quantity-input');
        document.getElementById('btn-plus')?.addEventListener('click', () => {
            if (quantityInput.value < 99) quantityInput.value++;
        });
        document.getElementById('btn-minus')?.addEventListener('click', () => {
            if (quantityInput.value > 1) quantityInput.value--;
        });
    });
</script>
@endpush
