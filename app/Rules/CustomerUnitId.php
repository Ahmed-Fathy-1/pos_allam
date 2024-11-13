<?php

namespace App\Rules;

use App\Models\CustomerPrice;
use Illuminate\Contracts\Validation\Rule;

class CustomerUnitId implements Rule
{
    protected $productId;

    public function __construct($productId)
    {
        $this->productId = $productId;
    }


    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        // Check if the unit_id is unique for the given product_id and customer_id
        return !CustomerPrice::where('product_id', $this->productId)
            ->where('customer_id', request()->input('special_prices')[$attribute]['customer_id'])
            ->where('unit_id', $value)
            ->exists();
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'The unit for this customer already exists. Please select a different unit.';
    }
}
