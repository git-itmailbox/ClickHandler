<?php

namespace App\Http\Controllers;

use App\Click;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClickController extends Controller
{
    //

    public function handleClick(Request $request)
    {
        $userAgent = $request->userAgent();
        $ip = $request->ip();
        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $ref = $request->get('HTTP_REFERER');

//        return response()->json([$request->toArray(), $request->headers->all()]);

        $click = new Click([
            'user_agent' => $userAgent,
            'ip' => $ip,
            'ref' => $ref,
            'param1' => $param1,
            'param2' => $param2
        ]);

        $click->save();

        return "saved";
        return response([$ref, $param1,$ip, $userAgent, sha1($userAgent.$ip.$param1)]);
    }
}
