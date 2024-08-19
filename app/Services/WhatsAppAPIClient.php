<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class WhatsAppAPIClient
{
    private string $apiKey;
    private string $baseUrl;
    private WhatsAppAPIResponseHandler $responseHandler;

    public function __construct($apiKey, $baseUrl, WhatsAppAPIResponseHandler $responseHandler)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->responseHandler = $responseHandler;
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    private function request($method, $path, $data = null): array
    {
        $url = $this->baseUrl . $path;
        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->send($method, $url, ['json' => $data]);
            return $this->responseHandler->handle($response);
        }
        catch (\Exception $e) {
            return [
                'success' => false, 'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @throws ConnectionException
     */
    public function startSession($sessionId): array
    {
        return $this->request('GET', "/session/start/{$sessionId}");
    }

    /**
     * @throws ConnectionException
     */
    public function getSessionStatus($sessionId): array
    {
        return $this->request('GET', "/session/status/{$sessionId}");
    }

    /**
     * @throws ConnectionException
     */
    public function getSessionQRCode($sessionId): array
    {
        return $this->request('GET', "/session/qr/{$sessionId}");
    }

    /**
     * @throws ConnectionException
     */
    public function terminateSession($sessionId): array
    {
        return $this->request('GET', "/session/terminate/{$sessionId}");
    }

    /**
     * @throws ConnectionException
     */
    public function sendMessage($sessionId, $message): array
    {
        $data = ['message' => $message];
        return $this->request('POST', "/message/send/{$sessionId}", $data);
    }
}
