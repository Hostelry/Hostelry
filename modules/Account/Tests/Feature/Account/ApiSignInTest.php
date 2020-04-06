<?php

declare(strict_types=1);

namespace Hostelry\Account\Tests\Feature\Account;

use Hostelry\Account\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class ApiSignInTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function successfulSignInWillReturnJsonUserData() : void
    {
        $username = $this->faker->email;
        $password = 'password';
        $api_token = Str::random(32);

        factory(User::class)->create([
            "username" => $username,
            "password" => Hash::make($password),
            "api_token" => $api_token,
        ]);

        $payload = [
            "username" => $username,
            "password" => $password,
        ];

        $response = $this->postJson(route('api.account.sign-in'), $payload);

        $response->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'api_token' => $api_token,
            ]);
    }

    /**
     * @test
     */
    public function unauthorizedAccount() : void
    {
        $username = $this->faker->email;
        $password = 'password';

        $payload = [
            "username" => $username,
            "password" => $password,
        ];

        $response = $this->postJson(route('api.account.sign-in'), $payload);
        $response->assertStatus(401);

    }

    /**
     * @test
     */
    public function mustRequireUsername() : void
    {
        $payload = [
            "password" => 'password',
        ];

        $response = $this->postJson(route('api.account.sign-in'), $payload);
        $response->assertJsonStructure(['errors']);
    }
}
