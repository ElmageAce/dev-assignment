<?php

namespace Tests\Feature;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{

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
            ->assertViewHas('posts', function($posts){
                return $posts instanceof CursorPaginator;
            });
    }
}
