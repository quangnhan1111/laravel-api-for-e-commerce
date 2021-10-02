<?php

namespace App\Services;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageService
{
    private ImageRepositoryInterface $imageRepositoryInterface;
    public function __construct(ImageRepositoryInterface $imageRepositoryInterface)
    {
        $this->imageRepositoryInterface = $imageRepositoryInterface;
    }

    public function getAll()
    {
        $colors = $this->imageRepositoryInterface->getAll();
        return $colors;
    }

    public function index()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $images = $this->imageRepositoryInterface->index();
            return $images;
        }
        return 'Unauthorized';
    }

    public function store($request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $image = new Image();
        if($user->isAdmin() || $user->isEmployee()) {
            $result = $this->imageRepositoryInterface->store($image, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $image = $this->imageRepositoryInterface->show($id);
        return $image;
    }

    public function update(ImageRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $imageUpdate=Image::query()->findOrFail($id);
            $result = $this->imageRepositoryInterface->update($imageUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $imageDestroy = $this->imageRepositoryInterface->destroy($id);
            return $imageDestroy;
        }
        return 'Unauthorized';
    }

}
