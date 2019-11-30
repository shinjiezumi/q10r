<?php

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QiitaApiService implements QiitaApiServiceInterface
{

	/**
	 *
	 */
	private const API_ROOT = 'https://qiita.com/';

	/**
	 * @param string $method
	 * @param string $path
	 * @param array $params
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function callApi(string $method, string $path, array $params) :array
	{
	    $user = Auth::user();

		$client = new Client([
			'base_uri' => self::API_ROOT,
		]);
		$requestParams = [
		    'headers' => [
                'Authorization' => 'Bearer ' . $user->getToken()
            ],
			RequestOptions::QUERY => $params
		];

		try {
            $response = $client->request($method, $path, $requestParams);
        } catch (\Exception $e) {
            $this->logging([
                'method' => $method,
                'path' => $path,
                'params' => $requestParams
            ]);
        }
		return json_decode($response->getBody()->getContents(), true);
	}

	private function logging($logInfo)
    {
        Log::error("[ERROR] API call error:" . var_export($logInfo, true));
    }
}