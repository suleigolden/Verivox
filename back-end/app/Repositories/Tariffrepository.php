<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tariff;


class Tariffrepository implements TariffRepositoryInterface
{
    /**
	 * Calculation: base costs per year 60€ + consumption costs 22 cent/kWh. Examples below:
	 * Consumption = 3500 kWh/year => Annual costs = 830 €/year (5€ * 12 months = 60 €
	 * base costs + 3500 kWh/year * 22 cent/kWh = 770 € consumption costs)
	 * Consumption = 4500 kWh/year => Annual costs = 1050 €/year (5€ * 12 months = 60 €
	 * base costs + 4500 kWh/year * 22 cent/kWh = 990 € consumption costs)
	 * Consumption = 6000 kWh/year => Annual costs = 1380 €/year (5€ * 12 months = 60 €
	 * base costs + 6000 kWh/year * 22 cent/kWh = 1320 € consumption costs)
	 */

    public function calculateTariff($request)
    {
        switch ($request->tariffName) {
            case 'BasicElectricityTariff':
                    return $this->calCulateBasicElectricityTariff($request);
                break;
            
            case 'PackagedTariff':
                    return $this->calCulatePackagedTariff($request);
                break;
            
            default:
                    return response()->json(['status' => 500, "result" => 'error please select a product:']);
                break;
        }
    }
    
    public function calCulateBasicElectricityTariff($request)
    {
            $baseCostsYearly = $request->yearlyConsumption; //KWH/YR
            $baseCostsPerMonth = 5.00;
            $consumption_costs = 0.22; //KWH
            $months = 12;
            $annualTariff = ($baseCostsPerMonth*$months) + ($baseCostsYearly*$consumption_costs);
            $this->storeTariff($request,$annualTariff);
            return response()->json(['status' => 200, "result" => $annualTariff, "data" => $this->all()]);
    }
    public function calCulatePackagedTariff($request)
    {
        $baseCostsYearly = $request->yearlyConsumption; //KWH/YR
        $baseCostsPerKWH = 0.30; //KWH
        $baseFee = 800; 
        $months = 12;
        $packageTariff = 0;

         if($baseCostsYearly <= 4000){
            $packageTariff = $baseFee;
         }else{
            $packageTariff = $baseFee + ($baseCostsYearly-4000) * $baseCostsPerKWH;
         }
        $this->storeTariff($request,$packageTariff);
        return response()->json(['status' => 200, "result" => $packageTariff, "data" => $this->all()]);
    }
    public function storeTariff($request,$annual_tariff)
    {
        $tariff = new Tariff();
        $tariff->name = $request->tariffName;
        $tariff->tariff_cost = $annual_tariff;
        $tariff->save();
        return true;
    }
    public function getTariff()
    {   
        return response()->json(['status' => 200, "data" => $this->all()]);
    }
    public function all()
    { 
        return Tariff::orderBy("tariff_cost", "ASC")->get();
        
    }

    
}
