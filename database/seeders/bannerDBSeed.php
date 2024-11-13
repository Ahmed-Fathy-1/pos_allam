<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class bannerDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::insert([
           [
                "title" => "Delicheese BEEF",
               "description" => "A tantalizing selection of prime beef cuts, expertly crafted for the discerning palate.",
               "category_id" => 1,
               "image" => "banner1.jpg",
               "text_color" => "#fcfcfc",
               "alt" => "banner image alt "
           ],
            [
                "title" => "Veal Vista",
                "description" => "Tender and succulent veal cuts, carefully curated for a delightful dining experience.",
                "category_id" => 2,
                "image" => "banner2.jpg",
                "text_color" => "#fcfcfc",
                "alt" => "banner image alt "
            ],
            [
                "title" => "Savory Delights from the G.O.A.T",
                "description" => "Discover the savory essence of goat meat – tender, flavorful, and perfect for your next culinary adventure.",
                "category_id" => 3,
                "image" => "bannerg1.png",
                "text_color" => "#fcfcfc",
                "alt" => "banner image alt "
            ],
            [
                "title" => " Banner Offerings of Delectable Lamb",
                "description" => " Banner Offerings of Delectable Lamb.",
                "category_id" => 4,
                "image" => "banner5.jpg",
                "text_color" => "#fcfcfc",
                "alt" => "banner image alt "
            ],
            [
                "title" => " Banner Selections for Bold Palates",
                "description" => "Discover the rich flavor of bison meat, lean and savory for gourmet cooking.",
                "category_id" => 5,
                "image" => "banner4.webp",
                "text_color" => "#fcfcfc",
                "alt" => "banner image alt "
            ],
        ]);
    }
}
