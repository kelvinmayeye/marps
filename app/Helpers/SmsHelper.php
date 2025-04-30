<?php

use Illuminate\Support\Facades\Http;


//$details should countain username,phon_number and token
function sendUserRegisterToken($details)
{
    $apiKey = config('services.beem_sms.key');
    $secretKey = config('services.beem_sms.secret');
    $senderId = config('services.beem_sms.sender_id');

    $postData = [
        'source_addr' => $senderId,
        'encoding' => 0,
        'schedule_time' => '',
        'message' => 'Hello, '.$details['user_names'].' Your Account request has been accepted use '.$details['token'] .'token to confirm ',
        'recipients' => [
            [
                'recipient_id' => '1',
                'dest_addr' => $details['phone_number'],
            ]
        ],
    ];

    $url = 'https://apisms.beem.africa/v1/send';

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$apiKey:$secretKey"),
            'Content-Type' => 'application/json',
        ])->post($url, $postData);

        if ($response->successful()) {
            // Handle success
            return $response->json();
        } else {
            // Log or handle failure
            \Log::error('Beem SMS Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return ['error' => 'SMS sending failed', 'details' => $response->body()];
        }
    } catch (\Exception $e) {
        \Log::error('Beem SMS Exception', ['message' => $e->getMessage()]);
        return ['error' => 'Exception occurred', 'message' => $e->getMessage()];
    }
}
