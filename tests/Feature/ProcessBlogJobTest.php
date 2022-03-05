<?php

namespace Tests\Feature;

use App\Jobs\ProcessBlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProcessBlogJobTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_process_jobs_post_inserts_new_post_in_database()
    {
        $user = User::factory()->create();
        $data = [
            'user_id' => $user->id,
            'title' => $this->faker->title,
            'description' => $this->faker->words(300, true),
            'publication_date' => now(),
            'slug' => $this->faker->unique()->slug,
        ];

        $job = new ProcessBlogPost($data);

        $job->handle();

        $this->assertDatabaseCount('posts', 1);
        $this->assertEquals(User::query()->first()->id, $user->id);
    }
}
