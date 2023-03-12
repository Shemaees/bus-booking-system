<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_can_login_with_correct_credentials()
    {
        $this->postJson(route('api.auth.login'), [
            'email' => 'mahmoudshemaees@gmail.com',
            'password' => 'password'
        ])
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => ['credentials'=>['access_token', 'token_type', 'expires_in']]
        ])->assertJson([
            'status'=> true,
            'message' => 'Logged In Successfully'
        ]);
    }

    public function test_login_with_invalid_credentials()
    {
        $this->postJson(route('api.auth.login'), [
            'email' => 'mahmoudshemaees@gmail.com',
            'password' => 'invalid-password'
        ])->assertStatus(Response::HTTP_BAD_REQUEST)->assertJson([
            'status'=> false,
            'data' => [],
            'message' => 'Invalid Email/Password'
        ]);
    }

    public function test_login_with_missing_credentials()
    {
        $this->postJson(route('api.auth.login'), [
            'email' => 'mahmoudshemaees@gmail.com',
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'data' => [
                    'errors' => [
                        'password'=> [
                            "The password field is required."
                        ]
                    ]
                ]
            ])
            ->assertJson(['status'=> false,'message' => 'Validation Error']);
    }
}
