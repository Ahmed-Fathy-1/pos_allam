<?php

namespace App\Enums;

enum PaymentTransferEnum: int
{
    case Manual = 0;
    case General = 1;
}
