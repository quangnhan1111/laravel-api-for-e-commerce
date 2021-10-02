<?php

namespace App\Services;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostService
{
    private PostRepositoryInterface $postRepositoryInterface;
    public function __construct(PostRepositoryInterface $postRepositoryInterface)
    {
        $this->postRepositoryInterface = $postRepositoryInterface;
    }

    public function index()
    {
        $posts = $this->postRepositoryInterface->index();
        return $posts;
    }

    public function store(PostRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $post = new Post();
        if($user->isAdmin() || $user->isEmployee()) {
            $result = $this->postRepositoryInterface->store($post, $inputs);;
            return $result;
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $post = $this->postRepositoryInterface->show($id);
        return $post;
    }

    public function update(PostRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $postUpdate=Post::query()->findOrFail($id);
            $result = $this->postRepositoryInterface->update($postUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $postDestroy = $this->postRepositoryInterface->destroy($id);
            return $postDestroy;
        }
        return 'Unauthorized';
    }

}
