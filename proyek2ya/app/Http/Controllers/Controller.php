<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function dashboard()
    {
        return view('user.page.dashboard');
    }
    public function market()
    {
        return view('user.page.market');
    }
    public function quiz()
    {
        return view('user.page.quiz');
    }
}
