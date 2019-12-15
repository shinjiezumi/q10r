<?php

namespace App\Services;


use App\Exceptions\QiitaApiException;
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
     * @throws QiitaApiException
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
		    throw new QiitaApiException($e->getMessage(), $e->getCode());
        } finally {
            $response = json_decode(isset($response) ? $response->getBody()->getContents() : '{}', true);
            Log::channel('qiitaapilog')->info(json_encode(
                [
                    'method' => $method,
                    'host' => self::API_ROOT,
                    'path' => $path,
                    'params' => $requestParams,
                    'response' => $response
                ],
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            ));
		}

		return $response;
	}
}