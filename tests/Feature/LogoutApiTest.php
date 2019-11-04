<?php

namespace Tests\Feature;

use App\Repositories\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutApiTest extends TestCase
{
	use RefreshDatabase;

	private $user;

	protected function setUp(): void
	{
		parent::setUp();

		// テストユーザー作成
		$this->user = factory(User::class)->create();
	}

	/**
     * @test
     */
    public function should_認証済みのユーザーをログアウトさせる()
    {
        $response = $this->actingAs($this->user)->json('POST', route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
