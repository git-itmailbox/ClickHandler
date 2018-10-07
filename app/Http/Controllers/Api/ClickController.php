<?php

namespace App\Http\Controllers\Api;

use App\Click;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClickController extends Controller
{
    public function getClicks(Request $request, $page=1)
    {
        return Click::all();
    }
}
