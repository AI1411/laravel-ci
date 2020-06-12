<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(400)
            ->assertViewIs('articles.index');
    }

    /**
     * @test
     */
    public function guestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function authCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('articles.create'));

        $response->assertStatus(200)->assertViewIs('articles.create');
    }
}
