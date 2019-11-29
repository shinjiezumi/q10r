<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\QiitaApiServiceInterface;
use App\Services\QiitaServiceInterface;
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
	private $qiitaService;

	/**
	 * @var
	 */
	private $qiitaApiService;

    /**
     * Create a new controller instance.
     *
     * @param QiitaServiceInterface $qiitaService
     * @param QiitaApiServiceInterface $qiitaApiService
     */
	public function __construct(QiitaServiceInterface $qiitaService, QiitaApiServiceInterface $qiitaApiService)
	{
		$this->middleware('guest')->except('logout');
		$this->qiitaService = $qiitaService;
		$this->qiitaApiService = $qiitaApiService;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('qiita')->scopes(['read_qiita'])->redirect();
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function handleProviderCallback(Request $request)
	{
		$providerUser = Socialite::driver('qiita')->user();
        $qiitaAccount = $this->qiitaService->findAccountById($providerUser->getId());
		if ($qiitaAccount) {
		    $this->qiitaService->storeAccessToken($qiitaAccount, $providerUser);
			Auth::login($qiitaAccount->user, true);
			return redirect('/');
		}

		$user = $this->qiitaService->createAccount($providerUser);

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
