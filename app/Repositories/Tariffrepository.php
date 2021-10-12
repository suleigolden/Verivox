<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class Tariffrepository implements TariffRepositoryInterface
{
    
    public function calCulateBasicElectricityTariff($data)
    {
        return 777;
    }
    public function calCulatePackagedTariff($data)
    {
        return 777;
    }
    public function all()
    {
        return 777;
    }
}
