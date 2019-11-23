<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SnsAccountServiceInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
	 * @var
	 */
	private $snsAccountService;

	/**
	 * Create a new controller instance.
	 *
	 * @param SnsAccountServiceInterface $snsAccountService
	 */
	public function __construct(SnsAccountServiceInterface $snsAccountService)
	{
		$this->middleware('guest')->except('logout');
		$this->snsAccountService = $snsAccountService;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('qiita')->redirect();
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function handleProviderCallback(Request $request)
	{
		$providerUser = Socialite::driver('qiita')->user();
		$snsAccount = $this->snsAccountService->findSnsAccountById($providerUser->getId());
		if ($snsAccount) {
			Auth::login($snsAccount->user, true);
			return redirect('/');
		}

		$user = $this->snsAccountService->createSnsAccount(
			$providerUser->getId(),
			$providerUser->getName(),
			$providerUser->getNickname(),
			$providerUser->getAvatar()
		);

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
