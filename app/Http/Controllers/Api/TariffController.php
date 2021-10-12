<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TariffRepositoryInterface;

class TariffController extends Controller
{

    protected $tariffRepository;
    public function __construct(TariffRepositoryInterface $tariffRepository)
    {
        $this->tariffRepository = $tariffRepository;
    }

    /**
     * Calculate Tariff.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateTariff(Request $request)
    {
        return $this->tariffRepository->calCulateBasicElectricityTariff($request);

        try {
            
            switch ($request->name) {
                case 'BasicElectricityTariff':
                        return $this->calCulateBasicElectricityTariff($request);
                    break;
                
                case 'PackagedTariff':
                        return $this->calCulatePackagedTariff($request);
                    break;
                
                default:
                        return response()->json(['status' => 500, "result" => 'error please select a product']);
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
            
            return response()->json(['status' => 200, "result" => $packageTariff]);
    }

}
