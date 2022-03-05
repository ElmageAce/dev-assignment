<?php

namespace Tests\Feature;

use Database\Seeders\SystemUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CommandTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_posts_command_saves_new_posts(): void
    {
        $this->seed(SystemUserSeeder::class);

        Http::fake(function(){
            return Http::response([
                'data' => [
                    [
                        'title' => $this->faker->title,
                        'description' => $this->faker->words(300, true),
                        'publication_date' => now(),
                    ],
                ],
            ]);
        });

        $this->artisan('posts:update')->assertSuccessful();

        $this->assertDatabaseCount('posts', 1);
    }

    public function test_update_posts_command_fails_when_feed_server_fails()
    {
        Http::fake(function(){
            return Http::response([
                'message' => 'Internal server error'
            ], 500);
        });

        Log::shouldReceive('error')
            ->with('There was an error fetching posts from feed server', [
                'message' => 'Internal server error'
            ])->once()->andReturnNull();

        $this->artisan('posts:update')
            ->assertFailed()
            ->assertExitCode(1);

        $this->assertDatabaseCount('posts', 0);
    }

    public function test_data_is_rolled_back_when_database_errors_occur(): void
    {
        $this->seed(SystemUserSeeder::class);

        Http::fake(function(){
            return Http::response([
                'data' => [
                    [
                        'title' => $this->faker->title,
                        'description' => $this->faker->words(300, true),
                        'publication_date' => now(),
                    ],
                    [
                        'title' => $this->faker->title,
                        'description' => $this->faker->words(300, true),
                        'publication_date' => now(),
                    ],
                    [
                        'description' => $this->faker->words(300, true),
                        'publication_date' => now(),
                    ],
                ],
            ]);
        });

        Log::shouldReceive('error')->once()->andReturnNull();

        $this->artisan('posts:update')
            ->assertFailed()
            ->assertExitCode(2);

        $this->assertDatabaseCount('posts', 0);
    }
}
