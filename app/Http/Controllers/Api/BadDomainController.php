<?php

namespace App\Http\Controllers\Api;

use App\BadDomain;
use App\Http\Resources\BadDomainCollection;
use App\Http\Resources\Clicks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BadDomainController extends Controller
{
    public function getBadDomains(Request $request)
    {

        $orderBy = $request->get('sortby', 'created_at');
        $order = $request->get('order', 'DESC');
        $perPage = $request->get('perpage', 3);
        $badDomains = BadDomain::orderBy($orderBy, $order);

        return new BadDomainCollection(
            $badDomains->paginate($perPage));
    }

    public function store(Request $request)
    {
        return BadDomain::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = BadDomain::findOrFail($id);
        $article->name= $request->get('name');
        $article->save();

        return response(['message'=>'ok']);

    }

    public function delete(Request $request, $id)
    {
        $article = BadDomain::findOrFail($id);
        $article->delete();

        return 204;
    }
}
