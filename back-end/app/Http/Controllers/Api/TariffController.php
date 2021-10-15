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
        
        try {
                return $this->tariffRepository->calculateTariff($request);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, "result" => 'error please try again...']);
        }

    }
     /**
     * Get Tariff.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTariff(Request $request)
    {

        try {
                return $this->tariffRepository->getTariff($request);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, "result" => 'error please try again...']);
        }

    }

   

}
