<?php

namespace Tests\Feature;

use App\Jobs\ProcessBlogPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_users_can_view_posts(): void
    {
        $post = Post::factory()->create();

        $response = $this->get('/'.$post->slug);

        $response->assertStatus(200);
    }

    public function test_auth_users_can_view_created_posts(): void
    {
        $this->actingAs(User::factory()->create(), 'web');

        $this->get('/posts')->assertOk()
            ->assertViewIs('posts.index')
            ->assertViewHasAll(['posts', 'sort_params', 'directions']);
    }

    public function test_guest_users_cannot_view_their_created_posts(): void
    {
        $this->get('/posts')->assertRedirect('/login');
    }

    public function test_post_data_is_rendered_when_viewed(): void
    {
        $created_post = Post::factory()->create();

        $response = $this->get('/'.$created_post->slug);

        $response->assertStatus(200)
            ->assertViewIs('posts.show')
            ->assertViewHas('post', function(Post $post) use ($created_post){
                return $post->slug === $created_post->slug;
            });
    }

    public function test_guest_users_cannot_view_create_post_page(): void
    {
        $this->get('/posts/create')->assertRedirect('/login');
    }

    public function test_auth_user_can_view_create_post_page(): void
    {
        $this->actingAs(User::factory()->create(), 'web');

        $response = $this->get('/posts/create');

        $response->assertOk()
            ->assertViewIs('posts.create');
    }

    public function test_guest_users_cannot_create_posts(): void
    {
        $this->post('/posts')->assertRedirect('/login');
    }

    public function test_auth_users_must_provide_required_body_params_to_create_posts(): void
    {
        $this->actingAs(User::factory()->create(), 'web');

        $this->post('/posts')
            ->assertRedirect('/')
            ->assertSessionHasErrors(['title', 'publication_date', 'description']);
    }

    public function test_publication_date_must_not_be_a_past_date(): void
    {
        $this->actingAs(User::factory()->create(), 'web');

        $response = $this->post('/posts', [
            'title' => $this->faker->title,
            'description' => $this->faker->words(500, true),
            'publication_date' => now()->subMinutes(10)->toString()
        ]);

        $response->assertRedirect('/')
            ->assertSessionDoesntHaveErrors(['title', 'description'])
            ->assertSessionHasErrors(['publication_date']);
    }

    public function test_auth_users_can_create_posts(): void
    {
        $this->actingAs(User::factory()->create(), 'web');

        $response = $this->post('/posts', [
            'title' => $this->faker->title,
            'description' => $this->faker->words(500, true),
            'publication_date' => now()->toString()
        ]);

        $response->assertRedirect('/posts')
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertDatabaseCount('posts', 1);
    }

    public function test_auth_users_created_post_is_queued(): void
    {
        Queue::fake();

        $this->actingAs(User::factory()->create(), 'web');

        $response = $this->post('/posts', [
            'title' => $this->faker->title,
            'description' => $this->faker->words(500, true),
            'publication_date' => now()->toString()
        ]);

        $response->assertRedirect('/posts')
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        Queue::assertPushedOn('high', ProcessBlogPost::class);
    }
}
