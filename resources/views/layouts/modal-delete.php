<div id="delete-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl border-t-4 border-red-500">
        <div class="text-center">
            <i class="fa-solid fa-triangle-exclamation text-red-500 text-4xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-4">¿Estás seguro?</h3>
            
            <form id="delete-form" method="POST" action="">
                <input type="hidden" name="id" id="delete-id" value="">
                <input type="hidden" name="product_id" id="delete-product-id" value="">
                <div class="flex flex-col gap-3">
                    <button type="submit" class="bg-red-600 text-white py-3 rounded-xl font-bold hover:bg-red-700 transition">Eliminar</button>
                    <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')" class="bg-gray-100 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-200 transition">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>