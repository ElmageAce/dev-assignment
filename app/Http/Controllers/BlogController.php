<?php

namespace App\Http\Controllers;

use App\Constants\PostConstants;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    final public function index(Request $request): View
    {
        $data = $request->validate([
            'sort_by' => [
                'bail', 'nullable', 'string', Rule::in(array_keys(PostConstants::SORT_PARAMS))
            ],
            'direction' => [
                'bail', 'nullable', 'string', Rule::in(array_keys(PostConstants::SORT_DIRECTIONS))
            ]
        ]);

        $params = array_merge(['per_page' => 12], array_filter($data));

        return view('index', [
            'posts' => Post::paginatePosts(...$params)->appends($data),
            'sort_params' => PostConstants::SORT_PARAMS,
            'directions' => PostConstants::SORT_DIRECTIONS,
        ]);
    }

}
