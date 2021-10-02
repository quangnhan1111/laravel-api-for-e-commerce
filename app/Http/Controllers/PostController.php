<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }//end __construct()

    public function index()
    {
        $posts = $this->postService->index();
        return $this->response("successfully", $posts, 200, true);
    }



    public function store(PostRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $post = $this->postService->store($request);
            return $this->response("successfully", $post, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $post = $this->postService->show($id);
        return $this->response("successfully", $post, 200, true);
    }

    public function update(PostRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $post = $this->postService->update($request, $id);
            return $this->response("successfully", $post, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $post = $this->postService->destroy($id);
            return $this->response("successfully", $post, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
