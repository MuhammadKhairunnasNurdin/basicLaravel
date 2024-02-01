<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TryRequestController extends Controller
{
    public function requestPath(Request $request): string
    {
        /**
         * If Url like: Http://example.com/foo/bar will return foo/bar
         */
        return $request->path();
    }

    public function requestUrlWithoutQueryString(Request $request): string
    {
        return $request->url();
    }

    public function requestUrlWithQueryString(Request $request): string
    {
        return $request->fullUrl();
    }

    public function checkHttpVerb(Request $request): string
    {
        if ($request->isMethod('POST')) {
            return 'post';
        }

        return strtolower($request->method());
    }

    public function testHeader(Request $request): array|string|null
    {
        if ($request->hasHeader('X-Whatever')) {
            return $request->header('X-Whatever');
        }

        return $request->header('X-Header-Name');
    }
}
