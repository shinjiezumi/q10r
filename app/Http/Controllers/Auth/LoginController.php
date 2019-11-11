<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\SnsAccount;
use App\Repositories\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('qiita')->redirect();
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function handleProviderCallback()
	{
		$providerUser = Socialite::driver('qiita')->user();

		$snsAccount = SnsAccount::where('provider_user_id', $providerUser->getId())->first();
		if ($snsAccount) {
			Auth::login($snsAccount->user, true);
			return redirect('/');
		}

		$user = new User();
		$user->unique_id = $providerUser->getNickname();
		$user->name = $providerUser->getName();
		$user->avatar = $providerUser->getAvatar();

		$snsAccount = new SnsAccount();
		$snsAccount->provider_user_id = $providerUser->getId();

		DB::transaction(function () use ($user, $snsAccount) {
			$user->save();
			$user->snsAccounts()->save($snsAccount);
		});

		Auth::login($user, true);
		return redirect('/');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function authenticated(Request $request, $user)
	{
		return $user;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function loggedOut(Request $request)
	{
		// セッションを再生成する
		$request->session()->regenerate();

		return response()->json();
	}
}
