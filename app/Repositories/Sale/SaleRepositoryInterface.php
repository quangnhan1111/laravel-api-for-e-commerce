<?php

namespace App\Repositories\Sale;
use App\Repositories\BaseRepositoryInterface;

interface SaleRepositoryInterface extends BaseRepositoryInterface
{
    public function getTotalProductSoldOut();

    public function getSaleFigureByDay();

    public function getSaleFigureByMonth();

    public function getSaleFigureByEmployee();

    public function getTotalUser();
}
