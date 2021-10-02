<?php
namespace App\Repositories\Post;
use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Utils\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    protected $model;

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $results = DB::select(DB::raw("SELECT posts.title, posts.content, posts.id, images.link as Link,
        images.name as Name, (images.updated_at)  as lastUpdated
        FROM images inner join posts on images.id = posts.image_id Where posts.deleted_at is null"));
        $helper = new Helper();
        return $helper->paginate($results);
    }

    public function show( $id)
    {
        $results = DB::select(DB::raw("SELECT posts.title, posts.content, posts.id,
       images.link as Link, images.name as Name, images.id as id_image
        FROM images inner join posts on images.id = posts.image_id Where posts.id = :id"),array('id' => $id));
        return $results;
    }

    public function store($objUpdate, $inputs)
    {
        $objUpdate->title = $inputs['title'];
        $objUpdate->content = $inputs['content'];
        $objUpdate->image_id = $inputs['image_id'];
        $objUpdate->save();
        return $objUpdate;
    }

    public function update($objUpdate, $inputs)
    {
        $objUpdate->title = $inputs['title'];
        $objUpdate->content = $inputs['content'];
        $objUpdate->image_id = $inputs['image_id'];
        $objUpdate->save();
        return $objUpdate;
    }

}
