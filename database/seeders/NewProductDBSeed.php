<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerPrice;
use App\Models\MetaSeo;
use App\Models\Product;
use App\Models\productPrice;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class NewProductDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, 36);
        $progressBar->start();
        $unitEa = Unit::create(['name' => 'EA','user_id' => 1]);
        $progressBar->advance();
        $category1 = Category::create(
            [
                "name" => "Bird",
                "description" => "Discover premium beef cuts expertly selected and skillfully prepared for unbeatable flavor and tenderness. From juicy steaks to savory roasts, our beef promises exceptional quality and taste for your next meal",
                "slug_url" => "Meat-Poultry",
                "images"  =>["category/Meat_Poultry.jpg"],
                "alts" => ["Discover premium beef cuts expertly selected and skillfully prepared for unbeatable"]
            ]);
        $id = $category1->id;

        MetaSeo::create([
            "title" => "Bird",
            "canonical_url" => "https://aitech.net.au/butcher",
            "keyword" => ["first keyword" , "second Keyword"],
            "description" => "meta Description Content",
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

            "category_id" =>$id,
            "created_at"  => now(),
            "updated_at" => now()
        ]);
        $progressBar->advance();
        $category2 = Category::create(
            [
                "name" => "bread",
                "description" => "Discover premium beef cuts expertly selected and skillfully prepared for unbeatable flavor and tenderness. From juicy steaks to savory roasts, our beef promises exceptional quality and taste for your next meal",
                "slug_url" => "bread",
                "images"  =>["category/sweet-bread.jpg"],
                "alts" => ["Discover premium beef cuts expertly selected and skillfully prepared for unbeatable"]
            ]);
        $id2 = $category2->id;
        MetaSeo::create([
            "title" => "Meat-Poultry",
            "canonical_url" => "https://aitech.net.au/butcher",
            "keyword" => ["first keyword" , "second Keyword"],
            "description" => "meta Description Content",
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

            "category_id" =>$id2,
            "created_at"  => now(),
            "updated_at" => now()
        ]);
        $progressBar->advance();

        $product1 = Product::create([
            'name' => "L-shoulder boneless",
            "slug_url" => "l-shoulder-boneless",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/sh_bon.jpg"],
            "alts" => ["products/sh_bon.jpg"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product1->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 13
            ],

        ]);
        $this->meta($product1->id);

        $progressBar->advance();
        $product2 = Product::create([
            'name' => "L-Breast fat",
            "slug_url" => "l-breast-fat",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/breat-fat.webp"],
            "alts" => ["products/breat-fat.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product2->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 11
            ],

        ]);
        $this->meta($product2->id);

        $progressBar->advance();
        $product3 = Product::create([
            'name' => "M-leg boneless",
            "slug_url" => "m-leg boneless",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 2,
            "images" => ["products/leg.jpg"],
            "alts" => ["products/leg.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product3->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 11
            ],

        ]);
        $this->meta($product3->id);

        $progressBar->advance();
        $product4 = Product::create([
            'name' => "fillet skin off",
            "slug_url" => "fillet-skin-off",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/fillet skin off.jpeg"],
            "alts" => ["products/fillet skin off.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product4->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 11
            ],

        ]);
        $this->meta($product4->id);

        $progressBar->advance();
        $product5 = Product::create([
            'name' => "tenderloin",
            "slug_url" => "tender-lion",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/tenderlion.jpeg"],
            "alts" => ["products/tenderlion.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product5->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 18
            ],

        ]);
        $this->meta($product5->id);

        $progressBar->advance();
        $product6 = Product::create([
            'name' => "L-backstrap ",
            "slug_url" => "l-backstrap",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 2,
            "images" => ["products/backstrap.jpeg"],
            "alts" => ["products/backstrap.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product6->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 27
            ],

        ]);

        $this->meta($product6->id);

        $progressBar->advance();

        $product7 = Product::create([
            'name' => "B-porterhouse steak",
            "slug_url" => "b-porterhouse-steak",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/Porterhouse_Steak.jpeg"],
            "alts" => ["products/Porterhouse_Steak.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product7->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 21
            ],

        ]);
        $this->meta($product7->id);

        $progressBar->advance();
        $product8 = Product::create([
            'name' => "B-Ribeye",
            "slug_url" => "b-ribeye",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/Ribeye_Roast.jpeg"],
            "alts" => ["products/Meat_Poultry.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product8->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 30
            ],

        ]);
        $this->meta($product8->id);

        $progressBar->advance();
        $product9 = Product::create([
            'name' => "B-TBone",
            "slug_url" => "b-tbone",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/tbone.jpeg"],
            "alts" => ["products/tbone.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product9->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 20
            ],

        ]);
        $this->meta($product9->id);

        $progressBar->advance();
        $product10 = Product::create([
            'name' => "frankfurt",
            "slug_url" => "frankfurt",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/frankfurts.webp"],
            "alts" => ["products/frankfurts.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product10->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 16.50
            ],

        ]);
        $this->meta($product10->id);

        $progressBar->advance();
        $product11 = Product::create([
            'name' => "Quail",
            "slug_url" => "quail",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id,
            "images" => ["products/quail.jpg"],
            "alts" => ["products/quail.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product11->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => $unitEa->id,
                "price" => 19.50
            ],
        ]);
        $this->meta($product11->id);

        $progressBar->advance();
       /* $product12 = Product::create([
            'name' => "Breast Fillet Skinon",
            "slug_url" => "breast-fillet-skinon",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id,
            "images" => ["products/breastfillet.jpeg"],
            "alts" => ["products/breastfillet.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product12->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 8.50
            ],

        ]);
        $this->meta($product12->id);

        $progressBar->advance();*/
        $product13 = Product::create([
            'name' => "l-shoulder Bone In",
            "slug_url" => "l-shoulder-bone-in",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 5,
            "images" => ["products/Beef-Shoulder.jpg"],
            "alts" => ["products/Beef-Shoulder.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product13->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 10.50
            ],

        ]);
        $this->meta($product13->id);

        $progressBar->advance();
        $product14 = Product::create([
            'name' => "l-shank",
            "slug_url" => "l-shank",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 2,
            "images" => ["products/lammhaxe.jpg"],
            "alts" => ["products/lammhaxe.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product14->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 10
            ],

        ]);
        $this->meta($product14->id);

        $progressBar->advance();
        $product15 = Product::create([
            'name' => "l-sweet bread",
            "slug_url" => "l-sweet-bread",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id2,
            "images" => ["products/Bread.jpg"],
            "alts" => ["products/Bread.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product15->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 11
            ],
        ]);
        $this->meta($product15->id);

        $progressBar->advance();

        $product16 = Product::create([
            'name' => "kidney",
            "slug_url" => "kidney",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/kidney.webp"],
            "alts" => ["products/kidney.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product16->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 8
            ],

        ]);
        $this->meta($product16->id);

        $progressBar->advance();
        $product17 = Product::create([
            'name' => "Liver",
            "slug_url" => "liver",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/liver.jpeg"],
            "alts" => ["products/liver.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product17->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => $unitEa->id,
                "price" => 4
            ],
        ]);
        $this->meta($product17->id);

        $progressBar->advance();
        $product18 = Product::create([
            'name' => "Breast Fillet Skin on ",
            "slug_url" => "breast-fillet-skin-on",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id,
            "images" => ["products/Chicken-Breast.jpg"],
            "alts" => ["products/Chicken-Breast.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product18->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 8.50
            ],
        ]);
        $this->meta($product18->id);
        $progressBar->advance();

        $product19 = Product::create([
            'name' => "Koufta",
            "slug_url" => "koufta",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/koufta.jpeg"],
            "alts" => ["products/koufta.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product19->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>15
            ],
        ]);
        $this->meta($product19->id);
        $progressBar->advance();

        $product20 = Product::create([
            'name' => "pastirma",
            "slug_url" => "pastirma",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/pastarma.jpeg"],
            "alts" => ["products/pastarma.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product20->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>48
            ],
        ]);
        $this->meta($product20->id);
        $progressBar->advance();

        $product21 = Product::create([
            'name' => "salami",
            "slug_url" => "salami",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/salami.jpeg"],
            "alts" => ["products/salami.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product21->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>18.50
            ],
        ]);
        $this->meta($product21->id);
        $progressBar->advance();

        $product22 = Product::create([
            'name' => "B-porterhouse",
            "slug_url" => "b-porterhouse",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/beef-porterhouse.jpg"],
            "alts" => ["products/beef-porterhouse.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product22->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>30
            ],
        ]);
        $this->meta($product22->id);
        $progressBar->advance();

        $product23 = Product::create([
            'name' => "B-Rump",
            "slug_url" => "b-rump",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/rump.jpg"],
            "alts" => ["products/rump.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product23->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>25
            ],
        ]);
        $this->meta($product23->id);
        $progressBar->advance();

        $product24 = Product::create([
            'name' => "L-mince",
            "slug_url" => "l-mince",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/mince.jpg"],
            "alts" => ["products/mince.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product24->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>13
            ],
        ]);
        $this->meta($product24->id);
        $progressBar->advance();
        $product25 = Product::create([
            'name' => "L-Neck",
            "slug_url" => "l-neck",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 4,
            "images" => ["products/Lamb-neck-slices_grande.webp"],
            "alts" => ["products/Lamb-neck-slices_grande.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product25->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>7
            ],
        ]);
        $this->meta($product25->id);
        $progressBar->advance();
        $product26 = Product::create([
            'name' => "L-Rack",
            "slug_url" => "m-rack",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 4,
            "images" => ["products/rack.webp"],
            "alts" => ["products/rack.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product26->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>18
            ],
        ]);
        $this->meta($product26->id);
        $progressBar->advance();
        $product27 = Product::create([
            'name' => "wings",
            "slug_url" => "wings",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id,
            "images" => ["products/wings2.jpg"],
            "alts" => ["products/wings2.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product27->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>7.50
            ],
        ]);
        $this->meta($product27->id);
        $progressBar->advance();

        $product28 = Product::create([
            'name' => "L-cutlet",
            "slug_url" => "l-cutlet",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/pork.webp"],
            "alts" => ["products/pork.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product28->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>30
            ],
        ]);
        $this->meta($product28->id);
        $progressBar->advance();

        $product29 = Product::create([
            'name' => "whole-chicken size 14",
            "slug_url" => "whole-chicken size 14",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id,
            "images" => ["products/check.jpeg"],
            "alts" => ["products/check.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product29->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>10
            ],
        ]);
        $this->meta($product29->id);
        $progressBar->advance();

        $product30 = Product::create([
            'name' => "potatoe chips",
            "slug_url" => "potatoe-chip",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => $id2,
            "images" => ["products/chipes2.jpg"],
            "alts" => ["products/chipes2.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product30->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => $unitEa->id,
                "price" =>13
            ],
        ]);
        $this->meta($product30->id);
        $progressBar->advance();

        $product31 = Product::create([
            'name' => "l-ribs",
            "slug_url" => "l-ribs",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/ribs.jpg"],
            "alts" => ["products/ribs.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product31->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>9
            ],
        ]);
        $this->meta($product31->id);
        $progressBar->advance();

        $product32 = Product::create([
            'name' => "l-sweetbread",
            "slug_url" => "sweetbread",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 2,
            "images" => ["products/vealsweatbread.webp"],
            "alts" => ["products/vealsweatbread.webp"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product32->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>9
            ],
        ]);
        $this->meta($product32->id);
        $progressBar->advance();
        $product33 = Product::create([
            'name' => "m-fillet skin",
            "slug_url" => "m-fillet-skin",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/fils.jpeg"],
            "alts" => ["products/fils.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product33->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>9
            ],
        ]);
        $this->meta($product33->id);
        $progressBar->advance();

        $product34 = Product::create([
            'name' => "topside",
            "slug_url" => "topside",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/topside.jpeg"],
            "alts" => ["products/topside.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product34->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>14
            ],
        ]);
        $this->meta($product34->id);
        $progressBar->advance();
        $product35 = Product::create([
            'name' => "tail fat",
            "slug_url" => "tail-fat",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/topside.jpeg"],
            "alts" => ["products/topside.jpeg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product35->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>15
            ],
        ]);
        $this->meta($product35->id);
        $progressBar->advance();
        $product36 = Product::create([
            'name' => "shauck",
            "slug_url" => "shauck",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/shack.jpg"],
            "alts" => ["products/shack.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product36->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>10.5
            ],
        ]);
        $this->meta($product36->id);
        $progressBar->advance();
        $product37 = Product::create([
            'name' => "caul fat",
            "slug_url" => "caul-fat",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/shack.jpg"],
            "alts" => ["products/shack.jpg"],
        ]);
        productPrice::insert([
            [
                "product_id" => $product37->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 1,
                "price" =>6
            ],
        ]);
        $this->meta($product37->id);
        $progressBar->advance();
        $progressBar->finish();
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

    private function customerPrice($productId,$unitId,$customerId,$price){
        CustomerPrice::create([
            "user_id" => 1,
            "product_id" => $productId,
            "unit_id" => $unitId,
            "customer_id" => $customerId,
            "price" => $price,
        ]);
    }
}
