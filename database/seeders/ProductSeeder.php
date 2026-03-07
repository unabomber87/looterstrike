<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getProducts() as $productData) {
            Product::firstOrCreate(
                ['amazon_asin' => $productData['amazon_asin']],
                $productData
            );
        }
    }

    /**
     * Get the products data.
     */
    private function getProducts(): array
    {
        return [
            [
                'title' => 'HyperX Cloud III Wired Gaming Headset',
                'category' => 'Headset',
                'amazon_asin' => 'B0DQQT2ZS3',
                'stars' => 5,
                'badge' => 'hot',
                'badge_label' => 'Hot',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'SteelSeries Rival 3 Wireless Gen 2',
                'category' => 'Mouse',
                'amazon_asin' => 'B0F69R79PH',
                'stars' => 4,
                'badge' => 'hot',
                'badge_label' => 'Hot',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'AULA F75 Pro Wireless Mechanical Keyboard',
                'category' => 'Keyboard',
                'amazon_asin' => 'B0D14N2QZF',
                'stars' => 4,
                'badge' => 'sale',
                'badge_label' => '-20%',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Razer DeathAdder Essential Gaming Mouse',
                'category' => 'Mouse',
                'amazon_asin' => 'B094PS5RZQ',
                'stars' => 5,
                'badge' => 'instock',
                'badge_label' => 'In Stock',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'SteelSeries Apex 3 TKL RGB Gaming Keyboard',
                'category' => 'Keyboard',
                'amazon_asin' => 'B09FTNMT84',
                'stars' => 4,
                'badge' => 'instock',
                'badge_label' => 'In Stock',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Logitech G PRO Mechanical Gaming Keyboard',
                'category' => 'Keyboard',
                'amazon_asin' => 'B07QQB9VCV',
                'stars' => 5,
                'badge' => 'hot',
                'badge_label' => 'Hot',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Logitech G305 LIGHTSPEED Wireless Mouse',
                'category' => 'Mouse',
                'amazon_asin' => 'B086PJKVVT',
                'stars' => 5,
                'badge' => 'sale',
                'badge_label' => '-15%',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Acer Nitro KG241Y 165Hz Gaming Monitor',
                'category' => 'Monitor',
                'amazon_asin' => 'B0B6DFG1FQ',
                'stars' => 4,
                'badge' => 'hot',
                'badge_label' => 'Hot',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'title' => 'Keycadets Gravity XXL Gaming Mouse Pad',
                'category' => 'Mousepad',
                'amazon_asin' => 'B09VYGYBMM',
                'stars' => 5,
                'badge' => 'instock',
                'badge_label' => 'In Stock',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'title' => 'Razer BlackShark V2 X Gaming Headset',
                'category' => 'Headset',
                'amazon_asin' => 'B086PKMZ21',
                'stars' => 4,
                'badge' => 'sale',
                'badge_label' => '-10%',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'MSI Force GC30V2 Wireless Gaming Controller',
                'category' => 'Controller',
                'amazon_asin' => 'B09PFBX39L',
                'stars' => 4,
                'badge' => 'instock',
                'badge_label' => 'In Stock',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'title' => 'Shcngqio 1080P HD Webcam with Microphone',
                'category' => 'Webcam',
                'amazon_asin' => 'B0G7ZX2ZYF',
                'stars' => 4,
                'badge' => 'hot',
                'badge_label' => 'Hot',
                'price' => 0.00,
                'image' => null,
                'is_active' => true,
                'sort_order' => 12,
            ],
        ];
    }
}
