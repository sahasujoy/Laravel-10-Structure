<?php

namespace App\Http\Controllers\V1\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function index(Request $request)
    {
        return redirect(route('user-dashboard'));
    }
}
