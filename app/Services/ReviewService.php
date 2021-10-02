<?php

namespace App\Services;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    private ReviewRepositoryInterface $reviewRepositoryInterface;
    public function __construct(ReviewRepositoryInterface $reviewRepositoryInterface)
    {
        $this->reviewRepositoryInterface = $reviewRepositoryInterface;
    }

    public function getAllReviewByIdProduct($nameProduct)
    {

        $reviews = $this->reviewRepositoryInterface->getAllReviewByIdProduct($nameProduct);
        return $reviews;

    }

    public function getGoodReview()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $reviews = $this->reviewRepositoryInterface->getGoodReview();
            return $reviews;
        }
        return 'Unauthorized';
    }

    public function index()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $reviews = $this->reviewRepositoryInterface->index();
            return $reviews;
        }
        return 'Unauthorized';
    }

    public function store(ReviewRequest $request)
    {
        $inputs = $request->all();
        $review = new Review();
        $result = $this->reviewRepositoryInterface->store($review, $inputs);;
        return $result;

    }

    public function show(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $review = $this->reviewRepositoryInterface->show($id);
            return $review;
        }
        return 'Unauthorized';
    }

    public function update(ReviewRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $reviewUpdate=Review::query()->findOrFail($id);
            $result = $this->reviewRepositoryInterface->update($reviewUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $reviewDestroy = $this->reviewRepositoryInterface->destroy($id);
            return $reviewDestroy;
        }
        return 'Unauthorized';
    }

}
