<?php

namespace App\Http\Controllers;

use App\Constants\PostConstants;
use App\Http\Requests\Posts\SortPostsRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * @param SortPostsRequest $request
     *
     * @return View
     */
    final public function index(SortPostsRequest $request): View
    {
        $data = $request->validated();

        $params = array_merge(['per_page' => 6], array_filter($data));

        return view('index', [
            'posts' => Post::paginatePosts(...$params)->appends($data),
            'sort_params' => PostConstants::SORT_PARAMS,
            'directions' => PostConstants::SORT_DIRECTIONS,
        ]);
    }

    /**
     * @param Post $post
     * @return View
     */
    final public function show(Post $post): View
    {
        $post->load('user');

        return view('posts.show', [
            'post' => $post,
        ]);
    }

}
