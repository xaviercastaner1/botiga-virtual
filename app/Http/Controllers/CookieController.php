<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller
{

    public function setCookie(Request $request)
    {
        $response = new Response('Setting Cookies...');
        $response->withCookie(cookie('name', json_encode('value'), 30));
        return $response;
    }
    public function getCookie(Request $request)
    {
        $value = $request->cookie('name');
        echo $value;
    }
}
