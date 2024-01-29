<?php
// app/Models/Result.php

namespace App\Models;

class Result
{
    public $apartment;
    public $distance;

    public function __construct($apartment, $distance)
    {
        $this->apartment = $apartment;
        $this->distance = $distance;
    }
}
