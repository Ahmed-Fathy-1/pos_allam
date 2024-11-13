<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case UnPaid = 0;
    case Paid = 1;
    case PartillyPaid = 2;
}
