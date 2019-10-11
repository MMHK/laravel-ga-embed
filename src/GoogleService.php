<?php
/**
 * Created by PhpStorm.
 * User: mixmedia
 * Date: 2019/10/11
 * Time: 11:39
 */

namespace MMHK\GA;


class GoogleService
{
    const CACHE_KEY = 'mmhk:ga:token';

    protected $config;

    protected $client;

    /**
     * GoogleService constructor.
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        $config_file_json_path = array_get($this->config, 'config-file');

        $this->client = new \Google_Client();
        $this->client->setAuthConfig($config_file_json_path);
        $this->client->addScope(\Google_Service_Analytics::ANALYTICS_READONLY);
    }

    public function getToken() {
        $accessToken = \Cache::get(self::CACHE_KEY);

        if ($accessToken) {
            return $accessToken;
        }

        $token = $this->client->fetchAccessTokenWithAssertion($this->client->authorize());
        $accessToken = array_get($token, 'access_token');
        $expire = array_get($token, 'expires_in', 0);

        \Cache::put(self::CACHE_KEY, $accessToken, ($expire / 60));

        return $accessToken;
    }

    public function render($view_id) {
        $token = $this->getToken();

        return view('ga-embed::dashboard',
            compact('view_id', 'token'))->render();
    }
}