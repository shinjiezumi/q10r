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
     * {@inheritDoc}
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

		$result = [];
        $response = null;
		try {
            $response = $client->request($method, $path, $requestParams);
        } catch (\Exception $e) {
            $result['statusCode'] = $e->getCode();
            $result['error'] = $e->getMessage();
        } finally {
            $contents = isset($response) ? $response->getBody()->getContents() : '{}';
            Log::channel('qiitaapilog')->info(json_encode(
                [
                    'method' => $method,
                    'host' => self::API_ROOT,
                    'path' => $path,
                    'params' => $requestParams,
                    'response' => json_decode($contents, true)
                ],
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            ));
            $result['statusCode'] = $response->getStatusCode();
            $result['headers'] = $response->getHeaders();
            $result['body'] = json_decode($contents, true);
        }

        return $result;
    }
}