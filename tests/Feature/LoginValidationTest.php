<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        User::create([
            'name'     => 'Joe',
            'email'    => 'joe@example.com',
            'password' => 'password123',
            'status'   => 'online'
        ]);
    }

    public function test_login_form_is_accessible()
    {
        $response = $this->get(route('login.form'));
        $response->assertStatus(200);
        $response->assertSee('login');
        $response->assertSee('email');
        $response->assertSee('password');
    }

    public function test_login_validation()
    {
        $response = $this->postJson(route('login'), []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);

        $response = $this->postJson(route('login'), [
            'email'    => 'not-an-email',
            'password' => 'password123',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);

        $response = $this->postJson(route('login'), [
            'email'    => 'joe@example.com',
            'password' => '123',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);

        $response = $this->postJson(route('login'), [
            'email'    => 'joe@example.com',
            'password' => 'password123',
        ]);
        $response->assertStatus(200);
    }
}
