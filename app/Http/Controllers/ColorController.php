<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Services\ColorService;
use Illuminate\Support\Facades\Auth;


class ColorController extends Controller
{

    private ColorService $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }//end __construct()

    public function getColorByGenderAndSize($gender_id, $size, $nameProduct){
        $categories = $this->colorService->getColorByGenderAndSize($gender_id, $size, $nameProduct);
        return $this->response("successfully", $categories, 200, true);
    }

    public function getColorByGenderAndSizeAndColor($color_id, $gender_id, $size, $nameProduct){
        $categories = $this->colorService->getColorByGenderAndSizeAndColor($color_id, $gender_id, $size, $nameProduct);
        return $this->response("successfully", $categories, 200, true);
    }

    public function getColors()
    {
        $categories = $this->colorService->getAll();
        return $this->response("successfully", $categories, 200, true);
    }

    public function index()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $colors = $this->colorService->index();
            return $this->response("successfully", $colors, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }



    public function store(ColorRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $color = $this->colorService->store($request);
            return $this->response("successfully", $color, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $user=Auth::user();
        if($this->authorize('view',$user)) {
            $color = $this->colorService->show($id);
            return $this->response("successfully", $color, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function update(ColorRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $color = $this->colorService->update($request, $id);
            return $this->response("successfully", $color, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $color = $this->colorService->destroy($id);
            return $this->response("successfully", $color, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
