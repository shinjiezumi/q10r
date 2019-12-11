<?php

namespace App\Http\Controllers;

use App\Jobs\ImportQiita;
use App\Services\QiitaServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QiitaController extends Controller
{
    private $qiitaService;

    /**
     * QiitaController constructor.
     * @param QiitaServiceInterface $qiitaService
     */
    public function __construct(QiitaServiceInterface $qiitaService)
    {
        $this->qiitaService = $qiitaService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getItems(Request $request)
    {
        $params = [
            'page' => 1,
            'per_page' => 20,
        ];

        return $this->qiitaService->getItems($params);
    }

    public function import(Request $request)
	{
		$user = Auth::User();
		ImportQiita::dispatchNow([
			'user_id' => $user->id,
			'qiita_user_id' => $user->getQiitaUserId()
		]);
	}
}
