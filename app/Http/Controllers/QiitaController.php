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
    public function getItems(Request $request) :array
    {
        $params = [
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 10),
        ];

        return $this->qiitaService->getItems($params);
    }

	/**
	 * @param Request $request
	 * @return array
	 */
	public function getTags(Request $request) :array
	{
		return $this->qiitaService->getTags();
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public function addTag(Request $request) :array
	{
		$tagName = $request->get('name');
		return $this->qiitaService->addTag($tagName);
	}

	/**
     * @param Request $request
     * @return mixed
     */
    public function import(Request $request)
	{
		$user = Auth::User();

		return ImportQiita::dispatchNow([
		    'user_id' => $user->id,
		    'qiita_user_name' => $user->getName(),
        ]);
	}
}
