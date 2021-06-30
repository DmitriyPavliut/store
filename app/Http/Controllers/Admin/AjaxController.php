<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index()
    {
        return $this->returnView('errors.404');
    }

    public function getProperties(Request $request)
    {

    }
}
