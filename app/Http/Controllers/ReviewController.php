<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }//end __construct()

    public function getAllReviewByIdProduct($nameProduct)
    {

        $reviews = $this->reviewService->getAllReviewByIdProduct($nameProduct);
        return $this->response("successfully", $reviews, 200, true);

    }

    public function getGoodReview()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $reviews = $this->reviewService->getGoodReview();
            return $this->response("successfully", $reviews, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function index()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $reviews = $this->reviewService->index();
            return $this->response("successfully", $reviews, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }



    public function store(ReviewRequest $request)
    {
        $review = $this->reviewService->store($request);
        return $this->response("successfully", $review, 200, true);
    }


    public function show($id)
    {
        $user=Auth::user();
        if($this->authorize('view',$user)) {
            $review = $this->reviewService->show($id);
            return $this->response("successfully", $review, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function update(ReviewRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $review = $this->reviewService->update($request, $id);
            return $this->response("successfully", $review, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $review = $this->reviewService->destroy($id);
            return $this->response("successfully", $review, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
