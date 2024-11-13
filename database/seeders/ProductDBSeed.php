<?php

namespace Database\Seeders;

use App\Models\MetaSeo;
use App\Models\Product;
use App\Models\productPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();
        $product1 = Product::create([
            'name' => "CUBES",
            "slug_url" => "cupes",
            "description" => "Our bone-in beef cubes combine a perfectly gamey, tender mouthfeel with savory succulence of marrow.
                            Our bone-in cuts are free of harsh additives, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.
                                We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.

                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.
                                First, our cows are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 1,
            "images" => ["products/pbeef2.webp", "products/pbeef3.webp"],
            "alts" => ["pbeef2.webp","pbeef3.webp"],
        ]);

        /* product_id	user_id	unit_id	price	new_price */
        productPrice::insert([
           [
               "product_id" => $product1->id,
               "stock" => 300,
               "user_id" => 1,
               "unit_id" => 1,
               "price" => 15.99,
               "discount" => 2.3,
               "gst"   => 3.2,
           ],
            [
                "product_id" => $product1->id,
                "stock" => 50,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 200,
                "discount" => 2.3,
                "gst"   => 3.2,
            ],
            [
                "product_id" => $product1->id,
                "stock" => 20,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 3872,
                "discount" => 2.3,
                "gst"   => 3.2,
            ],
            [
                "product_id" => $product1->id,
                "stock" => 10,
                "user_id" => 1,
                "unit_id" => 4,
                "price" => 7932,
                "discount" => 2.3,
                "gst"   => 3.2,
            ]
        ]);


        $product2 = Product::create([
            'name' => "PULAO MEAT",
            "slug_url" => "PULAO_MEAT",
            "description" => "The veal pulao meat, or simply veal pulao, is a staple of black tie dinners and formal dining to the highest order of quality.
                             Our wholesome veal pulao meat are incredibly flavorful and tender, incorporating a lower rib cut that’s sourced from local farmers who never use hormones to raise their livestock.

                                  We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher.
                                But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously.

                                First, our pulao are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our beef is not stunned before the slaughter.",
            "category_id" => 2,
            "images" => ["products/pvee1.webp","products/pveal2.jpg"],
            "alts" => ["pvee1.webp","pvee1.jpg"],
        ]);


        productPrice::insert([
            [
                "product_id" => $product2->id,
                "stock" => 1000,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 19.99,
                "discount" => 1.3,
                "gst"   => 2.2,
            ],
            [
                "product_id" => $product2->id,
                "stock" => 400,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 200,
                "discount" => 1.3,
                "gst"   => 2.2,
            ],
            [
                "product_id" => $product2->id,
                "stock" => 100,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 3072,
                "discount" => 1.3,
                "gst"   => 2.2,
            ],
            [
                "product_id" => $product2->id,
                "stock" => 50,
                "user_id" => 1,
                "unit_id" => 4,
                "price" => 7032,
                "discount" => 1.3,
                "gst"   => 2.2,
            ]
        ]);


        $product3 = Product::create([
            'name' => "GROUND GOAT",
            "slug_url" => "GROUND_GOAT",
            "description" => "Our ground goat contains the perfect combination of meat and fat (85-15), for a balanced production of lean bite with juicy, savory flavors.
                              All ground goat may look alike, but not all offerings are created equal: Our halal ground goat is antibiotic- and hormone-free. This pre-ground, tender goat is perfect for simple, quick dishes and easy dinners. Pan fry it with some seasoning, garnish, and voila! Or take some tasty hors d’oeuvres by crafting some delicious goat koftas. Either way, our ground goat is a perfect every-meal meat that’s sure to please at brunch, lunch or dinner.
                              We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher. But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously. First, our goats are raised on vegetarian diets that are free of hormones and other questionable ingredients. Second, they’re hand slaughtered by a real person. Lastly, and most importantly, our goat is not produced via electrocution or other stunning methods.
                                If you’re looking for goat ground meat that are inspected by USDA and produced in complete alignment with God’s wishes, you’ve come to the right place.

                                First, our goat are raised on vegetarian diets that are free of questionable ingredients.
                                Second, they’re hand slaughtered by a real person.
                                Lastly, and most importantly, our ground is not stunned before the slaughter.",
            "category_id" => 3,
            "images" =>["products/pgoat1.webp","products/pgoat2.jpg","products/pgoat3.jpg"],
            "alts" => ["pvee1.webp","pvee1.jpg"],
        ]);



        productPrice::insert([
            [
                "product_id" => $product3->id,
                "stock" => 330,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 21,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product3->id,
                "stock" => 120,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 298,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product3->id,
                "stock" => 120,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 1076,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product3->id,
                "stock" => 120,
                "user_id" => 1,
                "unit_id" => 4,
                "price" => 2987,
                "discount" => 0,
                "gst"   => 0,
          ]
        ]);


        $product4 = Product::create([
            'name' => "CUBES (GOSHT) & KABABS",
            "slug_url" => "GROUND_KABABS",
            "description" => "Our lamb kababs are free of harsh additives like hormones and antibiotics, so you can be sure you’re only getting the freshest, simplest, wholesome meat cuts.

                             We know that getting meat shipped from an online grocer seems like a lot of trouble—especially when it took you ages to find a local butcher. But, we assure you that it’s worth the hassle. At One Stop Halal, we take halal seriously. First, our lambs are raised on vegetarian diets that are free of hormones and other questionable ingredients. Second, they’re hand slaughtered by a real person. Lastly, and most importantly, our meat is not produced via electrocution or other stunning methods.

                                If you’re looking for lamb cubes that are inspected by USDA, you’ve come to the right place.

                                   Zabiha Halal - 100% hand slaughtered
                                No Stunning - Lamb wasn't electrocuted before the harvest
                                HFSAA Certified
                                Raised, butchered and slaughtered in accordance with the tenets of zabiha
                                Delicious and high-quality, this halal lamb cubes is perfect for lamb kababs or your favorite lamb dish
                                Ships in an insulated container to maintain freshness",
            "category_id" => 4,
            "images" => ["products/plamp.webp","products/pbeef2.webp"],
            "alts" =>["productsLamp","productsLamp"],
        ]);


        productPrice::insert([
            [
                "product_id" => $product4->id,
                "stock" => 1020,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 22,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product4->id,
                "stock" => 920,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 208,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product4->id,
                "stock" => 420,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 1076,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product4->id,
                "stock" => 320,
                "user_id" => 1,
                "unit_id" => 4,
                "price" => 2987,
                "discount" => 0,
                "gst"   => 0,
            ]
        ]);


        $product5 = Product::create([
            'name' => "Filet Mignon",
            "slug_url" => "Filet_Mignon",
            "description" => "You're getting ready for one of that all-too-rare dinner with your significant other, but your menu options seem limited. She has a fat-restricted diet and only a tiny allowance for red meat. The steaks in the fridge might be halal but don't necessarily scream luxury. Grass-fed Bison Filet Mignon is your answer for the creme-de-la-creme humane and luxury meat.
                                    Once thought of as ‘exotic,’ bison meat has gained a foothold in mainstream culture. The reasons for this are two-fold. First, its added tenderness and healthier nutritional profile make it an excellent option for those on heart-healthy diets. Second, it’s hard to tell apart from standard beef in a blind taste test. This allows it to be an easy substitute for traditional luxury recipes.
                                    Bison meat is more tender and lower in fat than beef
                                    Sourced from animals raised on wide open pastures
                                    Arrives ready for the grill—no prep work required
                                    Packaged to ensure long-term freshness and flavor
                                    Slaughtered by hand and certified halal",
            "category_id" => 5,
            "images" => ["products/pbison.webp","products/pbison2.webp","products/pbison3.webp"],
            "alts" => ["Filet Mignon1 ","Filet Mignon2","Filet Mignon3"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product5->id,
                "stock" => 320,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 76.4,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product5->id,
                "stock" => 300,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 500,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product5->id,
                "stock" => 70,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 3675,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
            "product_id" => $product5->id,
            "stock" => 40,
            "user_id" => 1,
            "unit_id" => 4,
            "price" => 7286,
            "discount" => 0,
            "gst"   => 0,
        ]
        ]);
        $product6 = Product::create([
            'name' => "MUTTON LEG",
            "slug_url" => "mutton-leg",
            "description" => "Mutton has a more assertive, meaty flavour than lamb, yet it's also lower in fat! For a soft, delicate, and flavourful meat, we recommend slow roasting the leg with shallots and plenty of garlic.",
            "category_id" => 5,
            "images" => ["products/image.jpg"],
            "alts" => ["mutton-leg "],
        ]);

        productPrice::insert([
            [
                "product_id" => $product6->id,
                "stock" => 1070,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 8.9,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product6->id,
                "stock" => 170,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 500,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product6->id,
                "stock" => 70,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 3675,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product6->id,
                "stock" => 10,
                "user_id" => 1,
                "unit_id" => 4,
                "price" => 7286,
                "discount" => 0,
                "gst"   => 0,
            ]
        ]);

        $product7 = Product::create([
            'name' => "Skirt Steak",
            "slug_url" => "skirt-steak",
            "description" => "Skirt steak is a flavorful cut of beef known for its rich taste and tenderness when cooked properly. It's a thin, long cut that comes from the diaphragm muscles of the cow. Skirt steak is excellent for marinating and can be cooked quickly at high heat, making it ideal for grilling, pan-searing, or broiling. Here's a simple way to cook skirt steak: Ingredients: - Skirt steak - Salt and pepper (or seasoning of your choice) .",
            "category_id" => 5,
            "images" => ["products/steack5.png"],
            "alts" => ["Skirt Steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product7->id,
                "stock" => 1070,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 18.9,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product7->id,
                "stock" => 170,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 500,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product7->id,
                "stock" => 70,
                "user_id" => 1,
                "unit_id" => 3,
                "price" => 3675,
                "discount" => 0,
                "gst"   => 0,
            ],
            [
                "product_id" => $product7->id,
                "stock" => 10,
                "user_id" => 1,
                "unit_id" => 4,
                "price" => 7286,
                "discount" => 0,
                "gst"   => 0,
            ]
        ]);
        $product8 = Product::create([
            'name' => "Steak-In Me Crazy Box",
            "slug_url" => "steak-in-me-crazy-box",
            "description" => "assortment of steak cuts or meat products offered by a particular brand or retailer.",
            "category_id" => 5,
            "images" => ["products/steack1.jpg"],
            "alts" => ["steak-in-me-crazy-box"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product8->id,
                "stock" => 170,
                "user_id" => 1,
                "unit_id" => 2,
                "price" => 240,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
        $product9 = Product::create([
            'name' => "featuring a ribeye steak",
            "slug_url" => "featuring-a-ribeye-steak",
            "description" => "featuring a ribeye steak that is exceptionally indulgent and satisfying for meat lovers. It's a creative or descriptive name given to a dish to emphasize its richness, quality, and appeal to those who enjoy high-quality cuts of beef.",
            "category_id" => 5,
            "images" => ["products/steack3.png"],
            "alts" => ["featuring-a-ribeye-steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product9->id,
                "stock" => 240,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 24,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
        $product10 = Product::create([
            'name' => "Halal Ribeye Steak",
            "slug_url" => "halal-ribeye-steak",
            "description" => "Halal ribeye steak refers to a ribeye steak cut from a halal-certified source and processed according to Islamic dietary laws. The ribeye steak is a highly prized and flavorful cut of beef known for its marbling, tenderness, and rich taste due to the intramuscular fat.",
            "category_id" => 5,
            "images" => ["products/steack2.jpg"],
            "alts" => ["halal-ribeye-steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product10->id,
                "stock" => 240,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 28,
                "discount" => 8,
                "gst"   => 2.2,
            ],

        ]);
        $product11 = Product::create([
            'name' => "ribeye steak",
            "slug_url" => "ribeye-steak",
            "description" => "Ribeye steak is a popular and highly prized cut of beef known for its tenderness, rich marbling, and robust flavor. It comes from the rib section of the cow and is composed primarily of the longissimus dorsi muscle, which doesn't bear much weight or do too much work, resulting in a more tender cut.",
            "category_id" => 5,
            "images" => ["products/steack4.jpg"],
            "alts" => ["ribeye-steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product11->id,
                "stock" => 240,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 23,
                "discount" => 4,
                "gst"   => 2.2,
            ],

        ]);
        $product12 = Product::create([
            'name' => "Halal Ribeye Steak",
            "slug_url" => "halal-ribeye-steak",
            "description" => "Halal ribeye steak refers to a ribeye steak cut from a halal-certified source and processed according to Islamic dietary laws. The ribeye steak is a highly prized and flavorful cut of beef known for its marbling, tenderness, and rich taste due to the intramuscular fat.",
            "category_id" => 5,
            "images" => ["products/steack2.jpg"],
            "alts" => ["halal-ribeye-steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product12->id,
                "stock" => 240,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 28,
                "discount" => 8,
                "gst"   => 2.2,
            ],

        ]);
        $product13 = Product::create([
            'name' => "Frenched Rib Chop",
            "slug_url" => "frenched-rib-chop",
            "description" => "A Frenched rib chop is a type of meat cut from the rib section of an animal, often specifically referring to beef or lamb. The term Frenched refers to a particular way of preparing the chop where the meat is trimmed away from the bone, exposing the bone for a more elegant presentation.",
            "category_id" => 4,
            "images" => ["products/lamp1.png"],
            "alts" => ["frenched-rib-chop"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product13->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 32,
                "discount" => 4,
                "gst"   => 2.2,
            ],

        ]);
        $product14 = Product::create([
            'name' => "Halal Lamb Shank",
            "slug_url" => "halal-lamb-shank",
            "description" => "A halal lamb shank refers to a lamb shank that is prepared according to Islamic dietary laws (halal). In Islamic dietary practices, halal refers to the proper way of slaughtering animals, following specific guidelines. For lamb to be considered halal, the animal must be slaughtered by a Muslim who recites a dedication, ensuring the animal's well-being and the use of a sharp knife to swiftly sever the main arteries in the neck. This process is intended to minimize the animal's suffering and is done while invoking the name of Allah.",
            "category_id" => 4,
            "images" => ["products/lamp3.jpg"],
            "alts" => ["halal-lamb-shank"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product14->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 35,
                "discount" => 2,
                "gst"   => 2.2,
            ],

        ]);
        $product15 = Product::create([
            'name' => "Halal Lamb Loin Chops",
            "slug_url" => "halal-lamb-loin-chops",
            "description" => "Halal lamb loin chops refer to lamb chops that have been prepared according to Islamic dietary laws (halal). Loin chops come from the loin area of the lamb and are known for their tenderness and flavor.",
            "category_id" => 4,
            "images" => ["products/lamp4.jpg"],
            "alts" => ["halal-lamb-loin-chops"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product15->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 29,
                "discount" => 2,
                "gst"   => 2.2,
            ],

        ]);
        $product16 = Product::create([
            'name' => "Halal Boneless Lamb Stew Meat",
            "slug_url" => "halal-boneless-lamb-stew-meat",
            "description" => "Halal boneless lamb stew meat refers to small pieces or chunks of lamb meat suitable for making stews or other slow-cooked dishes that adhere to Islamic dietary laws (halal). These cuts are typically taken from various parts of the lamb and are specifically prepared for cooking methods that require longer, slower heat to tenderize the meat and develop rich flavors in stews or curries.",
            "category_id" => 4,
            "images" => ["products/lamp2.jpg"],
            "alts" => ["halal-boneless-lamb-stew-meat"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product16->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 16.9,
                "discount" => 2,
                "gst"   => 2.2,
            ],

        ]);
        $product17 = Product::create([
            'name' => "Ground Beef",
            "slug_url" => "ground-beef",
            "description" => "Ground beef, also known as minced beef, is a versatile and commonly used form of beef that has been finely chopped or ground. It's used in various dishes such as burgers, meatballs, meatloaf, tacos, pasta sauces, and more. Here's a basic guide on how to cook ground beef.",
            "category_id" => 1,
            "images" => ["products/beef1.png"],
            "alts" => ["ground-beef"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product17->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 16.9,
                "discount" => 2,
                "gst"   => 2.2,
            ],

        ]);
        $product18 = Product::create([
            'name' => "Halal Beef - Lamb",
            "slug_url" => "halal-beef-lamb",
            "description" => "Halal beef and lamb refers to beef and lamb meat that adheres to Islamic dietary laws (halal). For meat to be considered halal, it must be sourced from animals that have been raised, slaughtered, and processed in accordance with Islamic guidelines. The key principles of halal meat ",
            "category_id" => 1,
            "images" => ["products/beef3.jpg"],
            "alts" => ["halal-beef-lamb"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product18->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 21.8,
                "discount" => 2,
                "gst"   => 2.2,
            ],

        ]);
        $product19 = Product::create([
            'name' => "Beef Gyro Slices",
            "slug_url" => "beef-gyro-slices",
            "description" => "Beef gyro slices are thinly sliced pieces of beef that have been marinated and seasoned, typically in a mixture of various spices such as oregano, garlic, paprika, cumin, and other flavorful ingredients.",
            "category_id" => 1,
            "images" => ["products/beef5.jpg"],
            "alts" => ["beef-gyro-slices"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product19->id,
                "stock" => 260,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 13,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
        $product20 = Product::create([
            'name' => "Beef Short Ribs",
            "slug_url" => "beef-short-ribs",
            "description" => "Beef short ribs are a flavorful and relatively tough cut of beef taken from the brisket, chuck, or rib areas of the cow. Short ribs are known for their rich taste and marbling, which contributes to their tenderness when cooked slowly.",
            "category_id" => 1,
            "images" => ["products/beef4.jpg"],
            "alts" => ["beef-short-ribs"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product20->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 18,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
        $product21 = Product::create([
            'name' => "Lean Ground Beef",
            "slug_url" => "lean-ground-beef",
            "description" => "Lean ground beef refers to ground beef that has a lower fat content compared to regular ground beef. It is made by grinding beef cuts with less fat, resulting in a product with reduced fat content.",
            "category_id" => 1,
            "images" => ["products/beef2.jpg"],
            "alts" => ["lean-ground-beef"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product21->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 18,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
        $product22 = Product::create([
            'name' => "Goat Meat steak",
            "slug_url" => "goat-meat-steak",
            "description" => "Goat meat can be prepared as steak, similar to how you'd prepare other types of meat steaks like beef or lamb. Goat steaks are often cut from the loin or leg, and they can be cooked in various ways, such as grilling, pan-searing, or broiling.",
            "category_id" => 3,
            "images" => ["products/goat2.jpg"],
            "alts" => ["goat-meat-steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product22->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 24,
                "discount" => 0,
                "gst"   => 2.1,
            ],

        ]);
        $product23 = Product::create([
            'name' => "Goat Meat Lamp",
            "slug_url" => "goat-meat-lamp",
            "description" => "Goat meat can be prepared as steak, similar to how you'd prepare other types of meat steaks like beef or lamb. Goat steaks are often cut from the loin or leg, and they can be cooked in various ways, such as grilling, pan-searing, or broiling.",
            "category_id" => 3,
            "images" => ["products/goat1.jpg"],
            "alts" => ["goat-meat-lamp"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product23->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 27,
                "discount" => 3,
                "gst"   => 2.1,
            ],

        ]);
        $product24 = Product::create([
            'name' => "Goat Meat ribs",
            "slug_url" => "goat-meat-ribs",
            "description" => "Goat meat can be prepared as steak, similar to how you'd prepare other types of meat steaks like beef or lamb. Goat steaks are often cut from the loin or leg, and they can be cooked in various ways, such as grilling, pan-searing, or broiling.",
            "category_id" => 3,
            "images" => ["products/goat4.jpg"],
            "alts" => ["goat-meat-ribs"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product24->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 43,
                "discount" => 3,
                "gst"   => 2.1,
            ],

        ]);
        $product25 = Product::create([
            'name' => "goat meat forezn",
            "slug_url" => "goat-meat-forezn",
            "description" => "Goat meat can be prepared as steak, similar to how you'd prepare other types of meat steaks like beef or lamb. Goat steaks are often cut from the loin or leg, and they can be cooked in various ways, such as grilling, pan-searing, or broiling.",
            "category_id" => 3,
            "images" => ["products/goat3.jpg","products/goat5.jpg"],
            "alts" => ["goat-meat-forezn"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product25->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 43,
                "discount" => 3,
                "gst"   => 2.1,
            ],

        ]);
        $product26 = Product::create([
            'name' => "Boneless Tenderloin Steak",
            "slug_url" => "boneless-tenderloin-steak",
            "description" => "Boneless tenderloin steak, often referred to as filet mignon, comes from the tenderloin area of the beef. It's known for its tenderness and mild flavor.",
            "category_id" => 2,
            "images" => ["products/veal1.png"],
            "alts" => ["boneless-tenderloin-steak"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product26->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 29,
                "discount" => 2,
                "gst"   => 3.1,
            ],

        ]);
        $product27 = Product::create([
            'name' => "Halal Beef Italian Rope Sausage",
            "slug_url" => "halal-beef-Italian-rope-sausage",
            "description" => "Halal beef Italian rope sausage refers to a type of sausage made from beef that complies with Islamic dietary laws (halal) and is seasoned in the style of Italian sausages.",
            "category_id" => 2,
            "images" => ["products/veal2.jpg"],
            "alts" => ["halal-beef-Italian-rope-sausage"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product27->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 9.6,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
        $product28 = Product::create([
            'name' => "Halal Hickory Smoked Breakfast Beef",
            "slug_url" => "halal-hickory-smoked-breakfast-beef",
            "description" => "Halal hickory smoked breakfast beef refers to a type of beef product that complies with Islamic dietary laws (halal) and is seasoned and smoked in the style often associated with breakfast meats.",
            "category_id" => 2,
            "images" => ["products/veal3.jpg"],
            "alts" => ["halal-hickory-smoked-breakfast-beef"],
        ]);

        productPrice::insert([
            [
                "product_id" => $product28->id,
                "stock" => 220,
                "user_id" => 1,
                "unit_id" => 1,
                "price" => 11,
                "discount" => 0,
                "gst"   => 0,
            ],

        ]);
    }
}
