<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class WhatsAppAPIResponseHandler
{
    /**
     * Handle the API response.
     *
     * @param $response
     * @return array
     * @throws Exception
     */
    public function handle($response): array
    {
        $status = $response->status();

        Log::info('WhatsApp API Response', [
            'status' => $status,
            'response' => $response->body()
        ]);

        if ($status >= 200 && $status < 500) {
            return $response->json();
        }
        else {
            throw new Exception('Internal Server Error');
        }
    }
}
