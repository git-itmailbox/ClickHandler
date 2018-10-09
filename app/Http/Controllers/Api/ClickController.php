<?php

namespace App\Http\Controllers\Api;

use App\Click;
use App\Http\Resources\ClickCollection;
use App\Http\Resources\Clicks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClickController extends Controller
{
    public function getClicks(Request $request)
    {
        return new ClickCollection(Click::paginate(3));
    }
}
