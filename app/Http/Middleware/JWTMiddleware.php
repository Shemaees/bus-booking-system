<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     */
    public function __construct()
    {

    }

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException){
                return response()->json([
                    'message' => 'Token is Invalid',
                    'status'  => FALSE
                ]);
            }else if ($exception instanceof TokenExpiredException){
                return response()->json([
                    'message' => 'Token is Expired',
                    'status'  => FALSE
                ]);
            }else if ($exception instanceof UnauthorizedHttpException || $exception instanceof TokenBlacklistedException){
                return response()->json([
                    'message' => 'The token has been unauthorized or blacklisted',
                    'status'  => FALSE
                ]);
            }else{
                return response()->json([
                    'message' => 'Authorization Token not found',
                    'status'  => FALSE
                ]);
            }
        }
        return $next($request);
    }
}
