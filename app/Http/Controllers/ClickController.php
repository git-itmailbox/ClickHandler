<?php

namespace App\Http\Controllers;

use App\BadDomain;
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

        $nullFields = collect([
            'user_agent' => $userAgent,
            'ip' => $ip,
            'param1' => $param1,
            ])->filter(function ($field){
            return $field == null || empty($field );
        });

        if($nullFields->isNotEmpty())
        {
            //return view with error, show what field are NULL
            dd($nullFields);
        }

        //check if click is already exists

        $click = new Click([
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
            'ref' => $request->get('HTTP_REFERER'),
            'param1' => $request->get('param1'),
            'param2' => $request->get('param2')
        ]);

        /** @var Click $found */
        $found = Click::find($click->generateId());

        if($found)
        {
            //returning to error page
            $found->incrementError();
            $found->save();
            //Check for bad domain
            $isBadDomain = $this->checkForBadDomain($found);
            return redirect()->route('error', ['id' => $found->id, 'redirectGoogle' => $isBadDomain]);
        }

        $click->save();

        return redirect()->route('success', ['id' => $click->id]);

//        return "saved";
//        return response([$ref, $param1,$ip, $userAgent, sha1($userAgent.$ip.$param1)]);
    }

    /**
     * Action show error page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error(Request $request, $id)
    {

        return view('error');
    }


    /**
     * Action show success page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request, $id)
    {
        return view('success', ['click' => Click::find($id)]);
    }

    private function checkForBadDomain(Click $found)
    {
        if($found->ref)
        {
            $badDomain = BadDomain::where('name', $found->ref)->first();
            return $badDomain? true : false;
        }
        return false;
    }
}
