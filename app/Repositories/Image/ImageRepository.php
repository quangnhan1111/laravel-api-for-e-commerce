<?php
namespace App\Repositories\Image;
use App\Models\Image;
use App\Repositories\BaseRepository;



class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{

    protected $model;

    public function __construct(Image $model)
    {
        parent::__construct($model);
    }


    public function store($objUpdate, $inputs)
    {
        $objUpdate->name = $inputs['name'];
//        if($inputs->hasFile('image')){
//            $file = $inputs->file('image');
//            $file_name = time().'.'.$file->getClientOriginalName();
//            $file->move(public_path('public/uploads/images'),$file_name);
//            $objUpdate->link = "public/uploads/images/".$file_name;
//            $objUpdate->save();
//            return $objUpdate;
//        }
        $objUpdate->link = $inputs['link'];
        $objUpdate->save();
        return $objUpdate;

    }

    public function update($objUpdate, $inputs)
    {
        $objUpdate->name = $inputs['name'];
        $objUpdate->link = $inputs['link'];
        $objUpdate->save();
        return $objUpdate;
    }

    public function getAll()
    {
        return $this->model::all();
    }
}
