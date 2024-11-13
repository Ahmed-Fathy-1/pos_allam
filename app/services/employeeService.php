<?php

namespace App\services;

class employeeService
{
    public function image($image){
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/public/employee', $filename);
        return $filename;
    }
}
