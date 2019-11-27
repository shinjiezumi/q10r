<?php

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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
			RequestOptions::JSON => $params
		];

		$response = $client->request($method, $path, $requestParams);

		return json_decode($response->getBody()->getContents(), true);
	}
}