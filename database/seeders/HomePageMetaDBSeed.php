<?php

namespace Database\Seeders;

use App\Models\MetaSeo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class HomePageMetaDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('meta_seos')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                "title" => "AbuSara",
                "canonical_url" => "https://aitech.net.au/abusara",
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
                "page_id" => 1,
                "product_id" => null,
                "category_id" => null,
                "created_at"  => now(),
                "updated_at" => now()
            ],

        ];
      foreach ($data as $item){
          MetaSeo::create($item);
      }
       /* for ($i = 7 ; $i <=28; $i++){
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
                    "product_id" =>$i,
                    "category_id" => null,
                    "created_at"  => now(),
                    "updated_at" => now()
                ]
            );
        }*/


    }
}
