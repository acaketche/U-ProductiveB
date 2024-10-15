<?php

namespace App\View\Components\Navbar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavItem extends Component
{
    public function __construct(public $route, public $text)
    {
        //
    }

    public function isActive()
    {
        return Route::is($this->route) ? 'active' : ''; // Use 'active' for Bootstrap
    }

    public function render(): View|Closure|string
    {
        return view('components.navbar.nav-item');
    }
}
