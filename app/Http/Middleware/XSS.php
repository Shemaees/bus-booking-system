<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = str_replace($request->url(), '', $request->fullUrl());
        $input = $request->all();

        if (preg_match('/(script|<script.*script>|<frame.*frame>|<iframe.*iframe>|<object.*object>|<embed.*embed>)/isU', $url)) {
            return redirect($request->url() . '/' . preg_replace('/(script|<script.*script>|<frame.*frame>|<iframe.*iframe>|<object.*object>|<embed.*embed>)/isU', '', strip_tags($url)));
        }

        array_walk_recursive($input, function (&$input) {
            $input = strip_tags($input);
        });


        $request->merge($input);
        return $next($request);
    }
}
