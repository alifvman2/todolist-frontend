<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AdonisApi
{
    
    protected static function token()
    {
        $token = session('auth_token');

        if (is_array($token) && isset($token['token'])) {
            return $token['token'];
        }

        if (is_string($token)) {
            return $token;
        }

        throw new \Exception('Missing or invalid auth token in session.');
    }

    protected static function csrfToken()
    {
        // Ambil dan decode token dari cookie Laravel
        $token = request()->cookie('XSRF-TOKEN');

        if (!$token) {
            throw new \Exception('Missing XSRF-TOKEN cookie');
        }

        return urldecode($token);
    }

    protected static function withDefaultHeaders()
    {
        $baseHost = parse_url(self::baseUrl(), PHP_URL_HOST);

        return Http::withToken(self::token())
            ->withHeaders([
                'X-XSRF-TOKEN' => self::csrfToken(),
            ])
            ->withCookies([
                'XSRF-TOKEN' => self::csrfToken()
            ], $baseHost)
            ->acceptJson();
    }

    protected static function baseUrl()
    {
        return config('services.adonis.base_url', env('APP_URL_API'));
    }

    public static function get($endpoint, array $params = [])
    {
        return self::withDefaultHeaders()
            ->get(self::baseUrl() . $endpoint, $params);
    }

    public static function post($endpoint, array $data = [])
    {
        return self::withDefaultHeaders()
            ->post(self::baseUrl() . $endpoint, $data);
    }

    public static function put($endpoint, array $data = [])
    {
        return self::withDefaultHeaders()
            ->put(self::baseUrl() . $endpoint, $data);
    }

    public static function delete($endpoint)
    {
        return self::withDefaultHeaders()
            ->delete(self::baseUrl() . $endpoint);
    }

}