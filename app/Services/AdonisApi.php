<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdonisApi
{
    protected static function token(): string
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

    protected static function baseUrl(): string
    {
        return config('services.adonis.base_url', env('APP_URL_API', 'http://127.0.0.1:3333'));
    }

    protected static function withDefaults()
    {
        $csrfCookie = urldecode(request()->cookie('XSRF-TOKEN'));

        return Http::withToken(self::token())
            ->withHeaders([
                'X-XSRF-TOKEN' => $csrfCookie,
                'Accept'       => 'application/json',
            ])
            ->withCookies([
                'XSRF-TOKEN' => $csrfCookie,
            ], parse_url(self::baseUrl(), PHP_URL_HOST));
    }

    public static function get(string $endpoint, array $query = [])
    {
        return self::withDefaults()->get(self::baseUrl() . $endpoint, $query);
    }

    public static function post(string $endpoint, array $data = [])
    {
        return self::withDefaults()->post(self::baseUrl() . $endpoint, $data);
    }

    public static function put(string $endpoint, array $data = [])
    {
        return self::withDefaults()->put(self::baseUrl() . $endpoint, $data);
    }

    public static function delete(string $endpoint, array $data = [])
    {
        return self::withDefaults()->delete(self::baseUrl() . $endpoint, $data);
    }

}