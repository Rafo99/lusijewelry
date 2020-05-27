<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrFail();
        $subCategory = $category->children()->first();

        $product = new Product();
        $product->sku = "sku-3";
        $product->price = 75000;
        $product->qty = 100;
        $product->picture = "/demo/pi1.jpg";
        $en = $product->getNewTranslation('en');
        $hy = $product->getNewTranslation('hy');
        $ru = $product->getNewTranslation('ru');
        $en->name = "Tzbex N1";
        $hy->name = "Թզբեխ Ն1";
        $ru->name = "Тзбех Н1";
        $en->description = "Tzbex N1 Description";
        $hy->description = "Թզբեխ Ն1 Նկարագրություն";
        $ru->description = "Тзбех Н1 Описание";
        $product->category_id = $category->id;
        $product->save();

        $product = new Product();
        $product->sku = "sku-4";
        $product->price = 99000;
        $product->qty = 15;
        $product->picture = "/demo/pi2.jpg";
        $en = $product->getNewTranslation('en');
        $hy = $product->getNewTranslation('hy');
        $ru = $product->getNewTranslation('ru');
        $en->name = "Tzbex N2";
        $hy->name = "Թզբեխ Ն2";
        $ru->name = "Тзбех Н2";
        $en->description = "Tzbex N2 Description";
        $hy->description = "Թզբեխ Ն2 Նկարագրություն";
        $ru->description = "Тзбех Н2 Описание";
        $product->category_id = $subCategory->id;
        $product->save();

    }
}
