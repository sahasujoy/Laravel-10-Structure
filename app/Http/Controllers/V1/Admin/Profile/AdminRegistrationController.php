<?php

namespace App\Http\Controllers\V1\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/admin/auth/login', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $data = $request->all();
            $check = $this->createAdmin($data);

            return redirect(route('dashboard'))->withSuccess('Great! You have Successfully logged in');
        } catch (Exception $exception) {
            return redirect()->back()->withErrors('Registration failed');
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createAdmin(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/admin/auth/register', ['pageConfigs' => $pageConfigs]);
    }

}
