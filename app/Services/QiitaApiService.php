<?php

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
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
		$client = new Client([
			'base_uri' => self::API_ROOT,
		]);
		$requestParams = [
			'debug' => true,
			'headers' => [
				'Content-Type' => 'application/json',
			],
			RequestOptions::JSON => array_merge([
				'client_id' => env('QIITA_CLIENT_ID'),
				'client_secret' => env('QIITA_CLIENT_SECRET'),
			], $params)
		];
		Log::debug(var_export($requestParams, true));

		$response = $client->request($method, $path, $requestParams);
		Log::debug((string)$response->getBody());

		return json_decode($response->getBody()->getContents(), true);
	}
}