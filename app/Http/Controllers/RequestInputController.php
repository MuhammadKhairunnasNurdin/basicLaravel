<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestInputController extends Controller
{
    public function tryAll(Request $request): array
    {
        return $request->all();
    }

    public function tryCollect(Request $request): float|int|null
    {
        if ($request->isMethod('GET')) {
            $arr = array_keys($request->toArray());

            return array_sum($arr) / count($arr);
        }

        return $request->collect()->avg();
    }

    public function tryInput(Request $request)
    {
        return $request->input('nameVar', 'default value');
    }

    public function tryInputNoArg(Request $request)
    {
        return $request->input();
    }

    public function tryInputArray(Request $request)
    {
        return $request->input('key1.*.key3', 'default');
    }

    public function tryInputJsonEncode(Request $request): false|string
    {
        return json_encode($request->input());
    }

    public function tryInputQueryParam(Request $request): array|string|null
    {
        return $request->query('param', 'default value');
    }
}
