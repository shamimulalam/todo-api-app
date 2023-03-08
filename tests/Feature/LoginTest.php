<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    protected string $password = 'password';

    public function test_a_user_can_login_using_a_email_and_password()
    {
        $user = $this->createUser();

        $response = $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => $this->password,
        ])->assertOk()->json();

        $this->assertArrayHasKey('token', $response);

    }
    public function test_if_a_user_email_is_not_existed_then_return_error()
    {
        $user = $this->createUser();
        $wrongEmail = 'a@a.a';


        $response = $this->postJson(route('user.login'), [
            'email' => $wrongEmail,
            'password' => $this->password,
        ])->assertNotFound()->json();

        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }
    public function test_if_a_user_password_is_incorrect()
    {
        $user = $this->createUser();
        $wrongPassword = 'a@a.a';


        $response = $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => $wrongPassword,
        ])->assertNotFound()->json();

        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }
}
