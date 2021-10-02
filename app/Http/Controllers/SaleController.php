<?php

namespace App\Http\Controllers;

use App\Services\SaleService;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    private SaleService $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }//end __construct()

    public function getTotalUser()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $totalUsers = $this->saleService->getTotalUser();
            return $this->response("successfully", $totalUsers, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getTotalProductSoldOut()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $totalProducts = $this->saleService->getTotalProductSoldOut();
            return $this->response("successfully", $totalProducts, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getSaleFigureByDay(){
        $user=Auth::user();
        if($this->authorize('view', $user)) {
            $total = $this->saleService->getSaleFigureByDay();
            return $this->response("successfully", $total, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getSaleFigureByMonth(){
        $user=Auth::user();
        if($this->authorize('view', $user)) {
            $total = $this->saleService->getSaleFigureByMonth();
            return $this->response("successfully", $total, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getSaleFigureByEmployee(){
        $user=Auth::user();
        if($this->authorize('view', $user)) {
            $total = $this->saleService->getSaleFigureByEmployee();
            return $this->response("successfully", $total, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


}
