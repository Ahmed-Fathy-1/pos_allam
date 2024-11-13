<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UnitRules  implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        $productUnits = [];

        foreach ($value as $order) {
            $key = $order['product_id'] . '-' . $order['unit'];
            if (in_array($key, $productUnits)) {
                return false;
            }
            $productUnits[] = $key;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'The combination of product and unit must be unique.';
    }
}
