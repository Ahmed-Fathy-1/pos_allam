<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MetaSeo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $category1 = Category::create(
            [
                "name" => "BEEF",
                "description" => "Discover premium beef cuts expertly selected and skillfully prepared for unbeatable flavor and tenderness. From juicy steaks to savory roasts, our beef promises exceptional quality and taste for your next meal",
                "slug_url" => "beef",
                "images"  =>["category/beef2.png"],
                "alts" => ["beef images "]
            ]);

        $category2 = Category::create(
            [
                "name" => "VEAL",
                "description" =>"Experience the delicate tenderness and subtle flavor of our exquisite veal cuts. Ethically sourced and expertly prepared, our veal offers a luxurious dining experience perfect for any occasion.",
                "slug_url" => "veal",
                "images"  =>["category/veal1.png"],
                "alts" => ["veal1 images "]
            ]);
        $category3 = Category::create(
            [
                "name" => "GOAT",
                "description" =>
                    "Savor the unique and savory taste of our goat meat selections. Known for its lean texture and rich flavor, our goat cuts are carefully sourced and expertly prepared to elevate your culinary adventures.",
                "slug_url" => "goat",
                "images"  => ["category/goat.png"],
                "alts" => ["veal1 images "]
            ]);
        $category4 = Category::create(
            [
                "name" => "LAMP",
                "description" =>
                    "Indulge in the delicate and succulent taste of our premium lamb cuts. Sourced from trusted farms and expertly butchered, our lamb offers unparalleled tenderness and flavor for your culinary creations.",
                "slug_url" => "lamp",
                "images"  => ["category/lamp.webp"],
                "alts" => ["lamp images "]
            ]);
        $category5 = Category::create(
            [
                "name" => "BISON",
                "description" =>
                    "Explore the bold and robust flavor of our bison cuts. Lean, flavorful, and sustainably sourced, our bison meat promises a unique and delicious dining experience for health-conscious carnivores.",
                "slug_url" => "bison",
                "images"  => ["category/bison.webp"],
                "alts" => ["bison images "]

          ]);


    }
}
