<?php

namespace App\Facades;

use App\Services\WhatsAppAPIResponseHandler;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static __construct( $apiKey, WhatsAppAPIResponseHandler $responseHandler,  $baseUrl = 'http://localhost:3000')
 * @method static array startSession( $sessionId)
 * @method static array getSessionStatus( $sessionId)
 * @method static array getSessionQRCode( $sessionId)
 * @method static array terminateSession( $sessionId)
 * @method static array sendMessage( $sessionId,  $message)
 *
 **/
class WhatsAppAPI extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'whatsappapi';
    }
}
