<?php

namespace TurnstileValidator;

class TurnstileValidator
{
    public static function verify($token)
    {
        if (!$token) {
            return false;
        }

        $secret = config('turnstile.secret'); // <<< innen húzzuk ki a secretet

        $data = [
            'secret' => $secret,
            'response' => $token,
        ];

        if (class_exists(\Illuminate\Support\Facades\Http::class)) {
            $response = \Illuminate\Support\Facades\Http::asForm()
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', $data);
            return $response->json('success', false);
        }

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
                'timeout' => 5,
            ],
        ];
        $context = stream_context_create($options);
        $result = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false, $context);

        if ($result === false) {
            return false;
        }

        $responseData = json_decode($result, true);

        return isset($responseData['success']) && $responseData['success'] === true;
    }
}
