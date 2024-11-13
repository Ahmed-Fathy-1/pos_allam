<?php

namespace Database\Seeders;

use App\Models\MetaSeo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMetaDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "title" => "Beef",
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

                "category_id" => 1,
                "created_at"  => now(),
                "updated_at" => now()
            ],
            [
                "title" => "VEAL",
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

                "category_id" => 2,
                "created_at"  => now(),
                "updated_at" => now()
            ],
            [
                "title" => "Goat",
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

                "category_id" => 3,
                "created_at"  => now(),
                "updated_at" => now()
            ],
            [
                "title" => "LAMP",
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

                "category_id" => 4,
                "created_at"  => now(),
                "updated_at" => now()
            ],
            [
                "title" => "Bison",
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

                "category_id" => 5,
                "created_at"  => now(),
                "updated_at" => now()
            ],
        ];
        foreach ($data as $item){
            MetaSeo::create($item);
        }
    }
}
