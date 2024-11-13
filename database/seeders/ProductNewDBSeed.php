<?php

namespace Database\Seeders;

use App\Models\CustomerPrice;
use App\Models\MetaSeo;
use App\Models\Product;
use App\Models\productPrice;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductNewDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit = Unit::latest('id')->value('id');
        $product1 = Product::create([
            'name' => "B-knuckle",
            "slug_url" => "b-knuckle",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/rump.jpg"],
            "alts" => ["products/rump.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product1->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 12.5
            ],

        ]);
        $this->meta($product1->id);

        $product2 = Product::create([
            'name' => "thigh-fillet",
            "slug_url" => "thigh-fillet",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/fils.jpeg"],
            "alts" => ["products/fils.jpeg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product2->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 12
            ],

        ]);
        $this->meta($product2->id);

        $product2 = Product::create([
            'name' => "thigh-fillet",
            "slug_url" => "thigh-fillet",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/fils.jpeg"],
            "alts" => ["products/fils.jpeg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product2->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 12
            ],

        ]);
        $this->meta($product2->id);

        $product3 = Product::create([
            'name' => "B-sliced",
            "slug_url" => "b-sliced",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/slicedd.jpeg"],
            "alts" => ["products/slicedd.jpeg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product3->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 15
            ],

        ]);
        $this->meta($product3->id);

        $product4 = Product::create([
            'name' => "B-shoulder sliced",
            "slug_url" => "b-shoulder-sliced",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/slicedd.jpeg"],
            "alts" => ["products/slicedd.jpeg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product4->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 14.5
            ],

        ]);
        $this->meta($product4->id);

        $product5 = Product::create([
            'name' => "Spring Roll ",
            "slug_url" => "Spring Roll ",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/roll.jpeg"],
            "alts" => ["products/roll.jpeg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product5->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => $unit,
                "price" => 12
            ],

        ]);
        $this->meta($product5->id);

        $product6 = Product::create([
            'name' => "samosa",
            "slug_url" => "samosa",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/samosa.jpeg"],
            "alts" => ["products/samosa.jpeg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product6->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => $unit,
                "price" => 12
            ],

        ]);
        $this->meta($product6->id);

        $product7 = Product::create([
            'name' => "M-Backstrap",
            "slug_url" => "m-backstrap",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/pbeef2.webp"],
            "alts" => ["products/pbeef2.webp"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product7->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 18.5
            ],

        ]);
        $this->meta($product7->id);
    }

    private function meta($id){
        MetaSeo::create(
            [
                "title" => "Product name",
                "canonical_url" => "https://Butchers.com.au/",
                "keyword" => ["first keyword" , "second Keyword"],
                "description" => "new Descriptions",
                "schema_markup" => '<script type="application/ld+json">
                                        {
                                            "@context": "http://schema.org",
                                            "@type": "WebSite",
                                            "url": "https://aitech.net.au/",
                                            "name": "Butcher - Halal meat",
                                            "description": "Brief description of your website.",
                                            "publisher": {
                                                "@type": "Organization",
                                                "name": "Your Organization Name",
                                                "logo": {
                                                    "@type": "ImageObject",
                                                    "url": "URL_to_your_logo_image"
                                                }
                                            },
                                            "image": {
                                                "@type": "ImageObject",
                                                "url": "URL_to_your_main_image",
                                                "width": 1200,
                                                "height": 600
                                            }
                                        }
                                        </script>',
                "page_id" => null,
                "product_id" =>$id,
                "category_id" => null,
                "created_at"  => now(),
                "updated_at" => now()
            ]
        );
    }
}
