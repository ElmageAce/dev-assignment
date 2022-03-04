<?php


namespace App\View\Components;


use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthLayout extends Component
{
    /**
     * @return View
     */
    final public function render(): View
    {
        return view('layouts.auth');
    }
}
