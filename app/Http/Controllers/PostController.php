<?php

namespace App\Http\Controllers;

use App\Constants\PostConstants;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\SortPostsRequest;
use App\Jobs\ProcessBlogPost;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * @param SortPostsRequest $request
     *
     * @return View
     */
    final public function index(SortPostsRequest $request): View
    {
        $data = $request->validated();

        $params = array_merge([
            'per_page' => 6,
            'user_id' => auth()->id(),
        ], array_filter($data));

        return view('posts.index', [
            'posts' => Post::paginateUserPosts(...$params)->appends($data),
            'sort_params' => PostConstants::SORT_PARAMS,
            'directions' => PostConstants::SORT_DIRECTIONS,
        ]);
    }

    /**
     * @return View
     */
    final public function create(): View
    {
        return view('posts.create');
    }

    /**
     * @param CreatePostRequest $request
     *
     * @return RedirectResponse
     */
    final public function store(CreatePostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        ProcessBlogPost::dispatch( array_merge($data, ['user_id' => auth()->id()]) )->onQueue('high');

        return redirect()
            ->route('posts.index')
            ->with('success', "Blog post is processing!");
    }
}
