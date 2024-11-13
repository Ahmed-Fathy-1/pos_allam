<?php

namespace App\services\category;

use App\Models\MetaSeo;

class categoryServices
{

        public function meta($categoryId,$title,$canonical,$keyword,$description,$schema_markup){
           $meta = MetaSeo::create([
                "title" => $title,
                "canonical_url" => $canonical,
                "keyword" => $keyword,
                "description" => $description,
                "schema_markup" => $schema_markup,
                "category_id" => $categoryId
            ]);
           $meta->refresh();
        }

}
