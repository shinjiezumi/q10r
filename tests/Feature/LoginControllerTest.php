<?php

namespace Tests\Feature;

use App\Repositories\User;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\UserTrait;

class LoginControllerTest extends TestCase
{
	use RefreshDatabase;
	use UserTrait;

	private $mockUser;
	private $mockProvider;

	public static function tearDownAfterClass()
	{
		parent::tearDownAfterClass();
		\Mockery::getConfiguration()->allowMockingNonExistentMethods(true);
	}

	/**
     * @test
     */
    public function should_新規登録してログインする()
    {
    	$this->setMock();
    	Socialite::shouldReceive('driver')->andReturn($this->mockProvider);

    	$this->get(route('qiitaCallback'))->assertStatus(302)->assertRedirect('/');

		$user = User::first();
		$this->assertSame('hogehoge', $user->nickname);
		$this->assertSame('hoge', $user->name);
		$this->assertSame('https://example.com/avatar.png', $user->avatar);

		$snsAccount = $user->snsAccounts()->first();
		$this->assertSame('id1', $snsAccount->provider_user_id);
		$this->assertAuthenticated();
	}

	/**
	 * @test
	 */
	public function should_登録済みのユーザーを認証して返却する()
	{
		$user = $this->createUser();
		$this->setMock($user);
		Socialite::shouldReceive('driver')->andReturn($this->mockProvider);

		$this->get(route('qiitaCallback'))->assertStatus(302)->assertRedirect('/');

		$this->assertAuthenticated();
	}

	/**
	 * @param User|null $user
	 */
	private function setMock(User $user = null) :void
	{
		$id = $user->id ?? 'id1';
		$name = $user->name ?? 'hoge';
		$nickName = $user->nickname ?? 'hogehoge';
		$avatar = $user->avatar ?? 'https://example.com/avatar.png';

		// テストユーザー作成
		\Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
		$this->mockUser = \Mockery::mock('Laravel\Socialite\Two\User');
		$this->mockUser
			->shouldReceive('getId')->andReturn($id)
			->shouldReceive('getName')->andReturn($name)
			->shouldReceive('getNickname')->andReturn($nickName)
			->shouldReceive('getAvatar')->andReturn($avatar);

		$this->mockProvider = \Mockery::mock('Laravel\Socialite\Contracts\Provider');
		$this->mockProvider->shouldReceive('user')->andReturn($this->mockUser);
	}
}
