<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register()
    {
        $user                          = User::factory()->make()->toArray();
        $user['password']              = 'password';
        $user['password_confirmation'] = 'password';

        $this->postJson(route('user.register'), $user)->assertCreated();

        $this->assertDatabaseHas('users', ['name' => $user['name']]);
    }
}
