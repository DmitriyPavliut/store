<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function returnView($view, $parameters=[])
    {
        $parameters['cartQuantity'] = isset($_COOKIE['cart_id']) ? \Cart::session($_COOKIE['cart_id'])->getTotalQuantity() : '0';
        return view($view,$parameters);
    }
}
