<?php
namespace App\Enums;

enum PaymentStatusEnum: int {
  case  Cash = 0;
  case Card = 1;
  case PanKTransfar = 2;
  case Balance = 3;
}
