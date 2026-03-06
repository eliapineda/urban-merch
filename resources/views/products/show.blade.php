@extends('layouts.app')

@section('content')
    {{-- Modales externos --}}
    @include('layouts.modal-login')

    {{-- Modal Añadido con Éxito (Lo ubicamos aquí como pediste) --}}
    <div id="cart-success-modal"
        class="fixed inset-0 z-[60] hidden flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl text-center">
            <div class="text-green-500 text-5xl mb-4"><i class="fa-solid fa-circle-check"></i></div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">¡Añadido al carrito!</h3>
            <p class="text-gray-600 mb-6">El producto se ha agregado correctamente.</p>
            <div class="flex flex-col gap-3">
                <a href="/cart" class="bg-black text-white py-3 rounded-xl font-bold hover:bg-gray-800 transition">Ver
                    Carrito</a>
                <button onclick="document.getElementById('cart-success-modal').classList.add('hidden')"
                    class="text-sm text-gray-400">Seguir comprando</button>
            </div>
        </div>
    </div>

    <div
        class="flex flex-col md:flex-row h-full min-h-96 max-w-6xl mx-auto justify-center gap-8 p-4 m-auto mt-10 md:mt-32 mb-20 md:mb-48">

        {{-- CARRUSEL --}}
        <div class="max-w-xl w-full md:w-3/5 mx-auto flex justify-center items-center">
            <div class="relative w-full md:w-4/5 overflow-hidden rounded-lg shadow-xl shadow-black/30 bg-gray-50">
                @if ($images->isEmpty())
                    <img src="{{ asset('storage/images/no-image.jpg') }}" class="w-full object-cover h-72 md:h-96">
                @else
                    <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
                        @foreach ($images as $img)
                            <img src="{{ str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path) }}"
                                class="w-full flex-shrink-0 object-cover h-72 md:h-96" alt="Imagen del producto">
                        @endforeach
                    </div>

                    @if ($images->count() > 1)
                        <button id="prev"
                            class="absolute top-1/2 left-2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2 shadow z-10">
                            &#8592; </button>
                        <button id="next"
                            class="absolute top-1/2 right-2 -translate-y-1/2 bg-white/70 hover:bg-white rounded-full p-2 shadow z-10">
                            &#8594; </button>
                    @endif
                @endif
            </div>
        </div>

        {{-- INFO PRODUCTO --}}
        <div class="w-full md:w-2/5 px-4 md:px-0">
            <h2 class="text-3xl md:text-4xl font-bold">{{ $product->product_name }}</h2>
            <p class="font-normal mt-4 text-gray-600">{{ $product->description }}</p>
            <p class="font-bold text-2xl mt-4">{{ number_format($product->price, 2) }} €</p>

            <div class="flex items-center mt-8 gap-4">
                <form id="cart-form" method="POST" action="/cart/addProduct"
                    class="flex flex-col sm:flex-row items-center gap-3 w-full">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div
                        class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden bg-white h-12 w-full sm:w-auto sm:min-w-[140px] justify-between">
                        <button type="button" id="btn-minus"
                            class="px-4 py-2 hover:bg-gray-100 font-bold text-xl">-</button>
                        <input type="number" name="quantity" id="quantity-input" value="1" min="1"
                            max="99" readonly
                            class="w-12 text-center font-bold bg-transparent border-none focus:ring-0">
                        <button type="button" id="btn-plus"
                            class="px-4 py-2 hover:bg-gray-100 font-bold text-xl">+</button>
                    </div>

                    <button type="submit"
                        class="w-full sm:flex-1 h-12 bg-black text-white px-6 rounded-xl font-bold hover:bg-gray-800 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Añadir</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- RELACIONADOS --}}
    <h2 class="text-4xl font-bold text-[#333] text-center">TE PUEDE INTERESAR</h2>
    <hr class="my-6 border-t-2 border-gray-300 w-96 m-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 p-8 max-w-6xl mx-auto">
        @foreach ($relatedProducts as $related)
            <div class="overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                <a href="/product/{{ $related->id }}" class="flex-1 flex flex-col">
                    <img src="{{ $related->mainImage ? asset('storage/' . $related->mainImage->image_path) : asset('images/no-image.jpg') }}"
                        class="w-full h-80 object-cover group-hover:scale-105 transition-transform"
                        alt="{{ $related->product_name }}">
                    <div class="p-4 flex justify-between items-center">
                        <h2 class="text-sm font-semibold text-gray-800">{{ $related->product_name }}</h2>
                        <p class="font-bold">{{ number_format($related->price, 2) }} €</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- OPINIONES --}}
    <h2 class="text-3xl md:text-4xl font-bold text-[#333] text-center mt-20">OPINIONES</h2>
    <hr class="my-6 border-t-2 border-gray-300 w-48 md:w-96 m-auto">

    <div class="flex flex-col md:flex-row gap-8 p-4 md:p-8 max-w-6xl mx-auto">
        <div class="w-full md:w-1/3">
            @auth
                <form action="/reviews/create" method="POST" class="space-y-4 bg-gray-50 p-6 rounded-2xl">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label class="block font-semibold">Puntuación</label>
                    <div id="star-rating" class="flex gap-1 cursor-pointer">
                        @for ($i = 1; $i <= 5; $i++)
                            <img src="{{ asset('images/star.png') }}" data-value="{{ $i }}"
                                class="w-6 h-6 opacity-30 hover:opacity-100 transition star-icon">
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-value" value="0">
                    <textarea name="content" class="w-full border-gray-200 p-3 rounded-xl min-h-24 focus:ring-black"
                        placeholder="Escribe tu opinión..." required></textarea>
                    <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700">Publicar
                        review</button>
                </form>
            @else
                <div class="text-center p-6 border-2 border-dashed rounded-2xl">
                    <p class="text-gray-500">Debes <a href="/login" class="text-blue-600 font-bold underline">iniciar
                            sesión</a> para opinar.</p>
                </div>
            @endauth
        </div>

        <div class="flex-1">
            @forelse ($reviews as $review)
                <div class="border border-gray-100 rounded-2xl p-6 mb-4 shadow-sm bg-white">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-bold text-gray-800">@ {{ $review->username }}</p>
                        <div class="flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <img src="{{ asset('images/star.png') }}"
                                    class="w-4 h-4 {{ $i <= $review->rating ? '' : 'grayscale opacity-20' }}">
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm italic">"{{ $review->content }}"</p>
                    <p class="text-right text-[10px] text-gray-400 font-bold mt-2 uppercase">
                        {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</p>
                </div>
            @empty
                <p class="text-center text-gray-400 italic mt-10">Aún no hay reseñas para este producto.</p>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const isLoggedIn = @json(auth()->check());

            // --- 1. CARRUSEL ---
            const carousel = document.getElementById('carousel');
            if (carousel) {
                let index = 0;
                const images = carousel.children;
                const total = images.length;

                document.getElementById('next')?.addEventListener('click', () => {
                    index = (index + 1) % total;
                    carousel.style.transform = `translateX(-${index * 100}%)`;
                });

                document.getElementById('prev')?.addEventListener('click', () => {
                    index = (index - 1 + total) % total;
                    carousel.style.transform = `translateX(-${index * 100}%)`;
                });
            }

            // --- 2. ESTRELLAS ---
            const stars = document.querySelectorAll(".star-icon");
            const ratingInput = document.getElementById("rating-value");
            if (stars.length > 0) {
                const updateStars = (val) => {
                    stars.forEach(s => s.style.opacity = (s.dataset.value <= val) ? "1" : "0.3");
                };
                stars.forEach(star => {
                    star.addEventListener("click", () => {
                        ratingInput.value = star.dataset.value;
                        updateStars(star.dataset.value);
                    });
                    star.addEventListener("mouseover", () => updateStars(star.dataset.value));
                    star.addEventListener("mouseout", () => updateStars(ratingInput.value));
                });
            }

            // --- 3. CANTIDAD ---
            const qtyInput = document.getElementById('quantity-input');
            document.getElementById('btn-plus')?.addEventListener('click', () => {
                if (qtyInput.value < 99) qtyInput.value = parseInt(qtyInput.value) + 1;
            });
            document.getElementById('btn-minus')?.addEventListener('click', () => {
                if (qtyInput.value > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
            });

            // --- 4. MODALES (LOGIN Y ÉXITO) ---
            const cartForm = document.getElementById('cart-form');
            const loginModal = document.getElementById('login-modal');
            const successModal = document.getElementById('cart-success-modal');

            cartForm?.addEventListener('submit', async (e) => {
                if (!isLoggedIn) {
                    e.preventDefault();
                    loginModal?.classList.remove('hidden');
                    return;
                }

                // Opcional: Enviar por AJAX para mostrar el modal de éxito sin recargar
                e.preventDefault();
                const formData = new FormData(cartForm);

                try {
                    const response = await fetch(cartForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        successModal?.classList.remove('hidden');
                    }
                } catch (err) {
                    cartForm.submit(); // Si falla el AJAX, enviamos normal
                }
            });
        });
    </script>
@endpush
