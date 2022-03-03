<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @return View
     */
    final public function index(): View
    {
        return view('index', [
            'posts' => null,
        ]);
    }
}
