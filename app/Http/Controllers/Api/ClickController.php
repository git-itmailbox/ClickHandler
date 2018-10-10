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

        $orderBy = $request->get('sortby', 'created_at');
        $order = $request->get('order', 'DESC');
        $perPage = $request->get('perpage', 3);
        $clicks = Click::orderBy($orderBy, $order);

        return new ClickCollection(
            $clicks->paginate($perPage));
    }
}
