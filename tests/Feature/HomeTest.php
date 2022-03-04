<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_proper_view(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('index');
    }

    public function test_visitors_can_view_blog_posts_on_homepage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewHas('posts', fn ($posts) => $posts instanceof Paginator)
            ->assertViewHasAll(['posts', 'sort_params', 'directions']);
    }

    public function test_visitors_must_provide_valid_input_to_sort_posts(): void
    {
        Post::factory()->count(10)->create();

        $response = $this->get('/?sort_by=invalid_field&direction=invalid_direction');

        $response->assertRedirect('/')
            ->assertSessionHasErrors(['sort_by', 'direction']);
    }

    public function test_visitors_can_sort_posts_by_publication_date(): void
    {
        Post::factory()->count(10)->create();

        $response = $this->get('/?sort_by=publication_date&direction=desc');

        $response->assertViewHas('posts', fn (Paginator $posts) => $posts->isNotEmpty());
    }
}
