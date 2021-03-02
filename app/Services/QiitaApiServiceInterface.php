<?php

namespace App\Services;

interface QiitaApiServiceInterface
{
    /**
     * @param string $method
     * @param string $path
     * @param array $params
     * @return array
     */
	public function callApi(string $method, string $path, array $params) :array;
}