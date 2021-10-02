<?php

namespace App\Repositories\Review;
use App\Repositories\BaseRepositoryInterface;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function getGoodReview();
    public function getAllReviewByIdProduct($nameProduct);
}
