<?php

namespace App\Repositories;

interface TariffRepositoryInterface
{
    public function all();

    public function calculateTariff($data);

    public function calCulateBasicElectricityTariff($data);

    public function calCulatePackagedTariff($data);

   
}
