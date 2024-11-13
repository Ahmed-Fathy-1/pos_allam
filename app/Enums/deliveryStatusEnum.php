<?php
namespace App\Enums;

enum deliveryStatusEnum:int{
    case  Pending = 1;
    case  InTransit = 2;
    case  Delivered = 3;
}

