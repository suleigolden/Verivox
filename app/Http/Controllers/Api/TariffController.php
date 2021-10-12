<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Calculate Tariff.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateTariff(Request $request)
    {

        try {
            
            switch ($request->name) {
                case 'BasicElectricityTariff':
                        return $this->calCulateBasicElectricityTariff($request);
                    break;
                
                default:
                    # code...
                    break;
            }
            
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, "result" => 'error please try again...']);
        }

    }

    public function calCulateBasicElectricityTariff($request)
    {
            $baseCostsYearly = $request->yearlyConsumption; //KWH/YR
            $baseCostsPerMonth = 5.00;
            $consumption_costs = 0.22; //KWH
            $months = 12;
            $annualTariff = ($baseCostsPerMonth*$months) + ($baseCostsYearly*$consumption_costs);
            return response()->json(['status' => 200, "result" => $annualTariff]);
    }

}
