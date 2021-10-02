<?php

namespace App\Services;



use App\Repositories\Sale\SaleRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SaleService
{
    private SaleRepositoryInterface $saleRepositoryInterface;
    public function __construct(SaleRepositoryInterface $saleRepositoryInterface)
    {
        $this->saleRepositoryInterface = $saleRepositoryInterface;
    }

    public function getTotalUser()
    {
        $user=Auth::user();
        if($user->isAdmin() ) {
            $totalUsers = $this->saleRepositoryInterface->getTotalUser();
            return $totalUsers;
        }
        return 'Unauthorized';
    }

    public function getTotalProductSoldOut()
    {
        $user=Auth::user();
        if($user->isAdmin() ) {
            $totalProducts = $this->saleRepositoryInterface->getTotalProductSoldOut();
            return $totalProducts;
        }
        return 'Unauthorized';
    }

    public function getSaleFigureByDay()
    {
        $user=Auth::user();
        if($user->isAdmin() ) {
            $totalProducts = $this->saleRepositoryInterface->getSaleFigureByDay();
            return $totalProducts;
        }
        return 'Unauthorized';
    }

    public function getSaleFigureByMonth()
    {
        $user=Auth::user();
        if($user->isAdmin() ) {
            $totalProducts = $this->saleRepositoryInterface->getSaleFigureByMonth();
            return $totalProducts;
        }
        return 'Unauthorized';
    }

    public function getSaleFigureByEmployee()
    {
        $user=Auth::user();
        if($user->isAdmin() ) {
            $totalProducts = $this->saleRepositoryInterface->getSaleFigureByEmployee();
            return $totalProducts;
        }
        return 'Unauthorized';
    }

}
