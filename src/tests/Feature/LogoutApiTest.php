<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\UserTrait;

class LogoutApiTest extends TestCase
{
	use RefreshDatabase;
	use UserTrait;

	private $user;

	protected function setUp(): void
	{
		parent::setUp();

		// テストユーザー作成
		$this->user = $this->createUser();
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
