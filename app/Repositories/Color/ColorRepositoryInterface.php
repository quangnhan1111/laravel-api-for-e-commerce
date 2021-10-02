<?php


namespace App\Repositories\Color;
use App\Repositories\BaseRepositoryInterface;

interface ColorRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();

    public function getColorByGenderAndSize($gender_id, $size, $nameProduct);

    public function getColorByGenderAndSizeAndColor($color_id, $gender_id, $size, $nameProduct);
}
