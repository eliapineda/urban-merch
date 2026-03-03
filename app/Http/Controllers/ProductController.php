<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * show home
     */
    public function home()
    {
        return view('home.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('mainImage')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Muestra el listado de productos para el administrador.
     */
    public function adminIndex()
    {
        // Cargamos los productos con su imagen principal
        $products = Product::with('mainImage')->get();

        // Retornamos la vista de administración (asegúrate de que la ruta del archivo sea correcta)
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($request->only('product_name', 'description', 'price'));
        if ($request->hasFile('images')) {
            $this->uploadImages($product->id, $request);
        }

        $this->notificacionN8N($product);

        return redirect()
            ->route('admin.products')
            ->with('toast_message', 'Producto creado correctamente')
            ->with('toast_type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['mainImage', 'images', 'reviews.user'])->findOrFail($id);

        $relatedProducts = Product::where('id', '!=', $id)
            ->take(4)
            ->with('mainImage')
            ->get();
        $relatedContext = $relatedProducts->pluck('product_name')->implode(', ');
        return view('products.show', compact('product', 'relatedProducts', 'relatedContext'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update($request->only('product_name', 'description', 'price'));
        $this->uploadImages($product->id, $request);


        return redirect()
            ->route('admin.products')
            ->with('toast_message', 'Producto actualizado correctamente')
            ->with('toast_type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()
            ->route('admin.products')
            ->with('toast_message', 'Producto eliminado correctamente')
            ->with('toast_type', 'success');
    }

    private function uploadImages($productId, Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $product = Product::findOrFail($productId);

        foreach ($request->file('images') as $image) {
            $path = $image->store('uploads/products', 'public');
            $product->images()->create(['image_path' => $path, 'is_main' => false]);
        }
    }

    private function notificacionN8N($product)
    {
        $url = 'http://mvc_n8n:5678/webhook-test/new-product';

        $response = Http::withHeaders([
            'X-Tienda-Token' => 'secret123',
        ])->post($url, [
                    'event' => 'new_merchandasing',
                    'producto' => $product->product_name,
                    'descripcion' => $product->description,
                    'precio' => $product->price,
                    'url_imagen' => $product->mainImage ? asset($product->mainImage->image_path) : null,
                    'url_producto' => route('products.show', $product->id),
                ]);
    }
}
