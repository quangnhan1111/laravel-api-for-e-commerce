<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{

    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }//end __construct()

    public function getImages()
    {
        $categories = $this->imageService->getAll();
        return $this->response("successfully", $categories, 200, true);
    }

    public function index()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $images = $this->imageService->index();
            return $this->response("successfully", $images, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }



    public function store(Request $request)
    {
//        if($request->hasFile('image')){
//            $file = $request->file('image');
//            $file_name = time().'.'.$file->getClientOriginalName();
//            $file->move(public_path('public/uploads/images').$file_name);
//        }
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $image = $this->imageService->store($request);
            return $this->response("successfully", $image, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $image = $this->imageService->show($id);
        return $this->response("successfully", $image, 200, true);
    }

    public function update(ImageRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $image = $this->imageService->update($request, $id);
            return $this->response("successfully", $image, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $image = $this->imageService->destroy($id);
            return $this->response("successfully", $image, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
