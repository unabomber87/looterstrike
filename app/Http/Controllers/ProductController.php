<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Retourne les produits actifs triés par sort_order ASC en JSON pour l'API publique.
     */
    public function index(): JsonResponse
    {
        $products = Product::active()->orderBy('sort_order', 'asc')->get();
        
        // Ajouter l'URL Amazon affiliation à chaque produit
        $products->transform(function ($product) {
            $product->amazon_url = 'https://www.amazon.com/dp/' . $product->amazon_asin . '?tag=looterstrike-20';
            return $product;
        });
        
        return response()->json($products);
    }

    /**
     * Liste tous les produits paginés 10 pour l'admin.
     */
    public function adminIndex(): View
    {
        $products = Product::orderBy('sort_order', 'asc')->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau produit.
     */
    public function create(): View
    {
        return view('admin.products.create');
    }

    /**
     * Enregistre un nouveau produit.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'amazon_asin' => 'required|string|max:20',
            'badge' => 'nullable|string|max:50',
            'badge_label' => 'nullable|string|max:50',
            'stars' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un produit existant.
     */
    public function edit(Product $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Met à jour un produit existant.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'amazon_asin' => 'required|string|max:20',
            'badge' => 'nullable|string|max:50',
            'badge_label' => 'nullable|string|max:50',
            'stars' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprime un produit.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
