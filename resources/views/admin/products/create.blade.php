@extends('layouts.app')

@section('title', 'Ajouter un Produit')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Ajouter un produit</h1>
                <p class="text-gray-500 mt-1">Ajoutez un nouveau produit au carrousel gaming</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre du produit</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="Ex: HyperX Cloud III Wired Gaming Headset">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select name="category" id="category" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="Mouse" {{ old('category') == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                        <option value="Keyboard" {{ old('category') == 'Keyboard' ? 'selected' : '' }}>Keyboard</option>
                        <option value="Headset" {{ old('category') == 'Headset' ? 'selected' : '' }}>Headset</option>
                        <option value="Monitor" {{ old('category') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                        <option value="Chair" {{ old('category') == 'Chair' ? 'selected' : '' }}>Chair</option>
                        <option value="Controller" {{ old('category') == 'Controller' ? 'selected' : '' }}>Controller</option>
                        <option value="Mousepad" {{ old('category') == 'Mousepad' ? 'selected' : '' }}>Mousepad</option>
                        <option value="Webcam" {{ old('category') == 'Webcam' ? 'selected' : '' }}>Webcam</option>
                        <option value="Microphone" {{ old('category') == 'Microphone' ? 'selected' : '' }}>Microphone</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prix ($)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', 0.00) }}" step="0.01" min="0" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amazon ASIN -->
                <div>
                    <label for="amazon_asin" class="block text-sm font-medium text-gray-700 mb-2">Amazon ASIN</label>
                    <input type="text" name="amazon_asin" id="amazon_asin" value="{{ old('amazon_asin') }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="Ex: B0DQQT2ZS3">
                    @error('amazon_asin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Aperçu URL affiliée -->
                    <div id="amazon_url_preview" class="mt-2 p-2 bg-gray-100 rounded hidden">
                        <p class="text-xs text-gray-500">URL affiliée:</p>
                        <a href="#" id="preview_link" target="_blank" class="text-blue-600 text-sm hover:underline break-all">
                            https://www.amazon.com/dp/?tag=looterstrike-20
                        </a>
                    </div>
                </div>

                <!-- Image URL -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">URL de l'image (optionnel)</label>
                    <input type="url" name="image" id="image" value="{{ old('image') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="https://...">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Badge -->
                <div>
                    <label for="badge" class="block text-sm font-medium text-gray-700 mb-2">Badge</label>
                    <select name="badge" id="badge"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <option value="">Aucun badge</option>
                        <option value="hot" {{ old('badge') == 'hot' ? 'selected' : '' }}>Hot</option>
                        <option value="sale" {{ old('badge') == 'sale' ? 'selected' : '' }}>Sale</option>
                        <option value="instock" {{ old('badge') == 'instock' ? 'selected' : '' }}>In Stock</option>
                        <option value="outstock" {{ old('badge') == 'outstock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                    @error('badge')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Badge Label -->
                <div>
                    <label for="badge_label" class="block text-sm font-medium text-gray-700 mb-2">Texte du badge</label>
                    <input type="text" name="badge_label" id="badge_label" value="{{ old('badge_label') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="Ex: Hot, -20%, In Stock">
                    @error('badge_label')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stars -->
                <div>
                    <label for="stars" class="block text-sm font-medium text-gray-700 mb-2">Note (1-5 étoiles)</label>
                    <select name="stars" id="stars" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('stars', 5) == $i ? 'selected' : '' }}>{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                    @error('stars')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    @error('sort_order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 border-gray-300 rounded focus:ring-blue-500 text-blue-600">
                        <span class="text-sm font-medium text-gray-700">Produit actif</span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Créer le produit
                </button>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const asinInput = document.getElementById('amazon_asin');
    const previewDiv = document.getElementById('amazon_url_preview');
    const previewLink = document.getElementById('preview_link');

    asinInput.addEventListener('input', function() {
        const asin = this.value.trim();
        if (asin.length > 0) {
            const url = 'https://www.amazon.com/dp/' + asin + '?tag=looterstrike-20';
            previewLink.href = url;
            previewLink.textContent = url;
            previewDiv.classList.remove('hidden');
        } else {
            previewDiv.classList.add('hidden');
        }
    });
});
</script>
@endsection
