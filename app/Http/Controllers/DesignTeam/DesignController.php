<?php

namespace App\Http\Controllers\DesignTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index(){
        return view('design.form-create');
    } 

}
