<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiLoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(ApiLoginRequest $request)
    {
        try {
            if ($errors = $this->loginValidator($request->all())) {
                return $errors;
            }
            return $this->createCredential($request->only('email', 'password'));
        }
        catch (JWTException $e)
        {
            return $this->returnJsonResponse('there is something wrong. please, try again later', [],
                FALSE, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        try {
            $this->guard()->logout();
            return $this->returnJsonResponse('Successfully logged out');
        }
        catch (JWTException $e)
        {
            return $this->returnJsonResponse('there is something wrong. please, try again later',
                [], FALSE, Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        try {
            return $this->createNewToken($this->guard()->refresh());
        }
        catch (JWTException $e)
        {
            return $this->returnJsonResponse('there is something wrong. please, try again later',
                [], FALSE, Response::HTTP_BAD_REQUEST);
        }
    }
    protected function createCredential($credentials)
    {
        if (!$token = $this->guard()->attempt($credentials)) {
            return $this->returnJsonResponse('Invalid Email/Password',
                [], FALSE, Response::HTTP_BAD_REQUEST);
        }
        if (auth('api')->user()->status == 0) {
            $this->logout();
            return $this->returnJsonResponse('Sorry, This account is blocked ',
                [],FALSE, Response::HTTP_BAD_REQUEST);
        }
        else {
            return $this->createNewToken($token);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function createNewToken(string $token)
    {
        return $this->returnJsonResponse('Logged In Successfully',
            [
                "credentials" =>[
                    'access_token'          => $token,
                    'token_type'            => 'bearer',
                    'expires_in'            => $this->guard()->factory()->getTTL() * 7200
                ],
//                "profile" => [auth('api')->user()]
            ]
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    public function guard()
    {
        return auth('api');
    }

    public function loginValidator($data)
    {
        $validator = Validator::make($data, [
            'email'=>'required|email|',
            'password'=>'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return $this->returnJsonResponse("Validation Error",
                $validator->errors()->toArray(), FALSE, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
