<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_posts(): void
    {
        $post = Post::factory()->create();

        $response = $this->get('/'.$post->slug);

        $response->assertStatus(200);
    }
}
