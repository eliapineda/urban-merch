<div id="login-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl">
        <div><p onclick="document.getElementById('login-modal').classList.add('hidden')" class="cursor-pointer text-right"><i class="fa-solid fa-x"></i></p></div>
        <div class="text-center">
            <h3 class="text-xl font-bold text-gray-900 mb-2">¡Inicia sesión!</h3>
            <p class="text-gray-600 mb-6">Debes estar registrado para añadir productos al carrito.</p>
            <div class="flex flex-col gap-3">
                <a href="/login" class="bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">Iniciar Sesión</a>
                <a href="/register" class="bg-gray-100 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-200 transition text-center">Registrarse</a>
                <button onclick="document.getElementById('login-modal').classList.add('hidden')" class="text-sm text-gray-400 mt-2">Cerrar</button>
            </div>
        </div>
    </div>
</div>