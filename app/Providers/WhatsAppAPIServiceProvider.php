<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use App\Services\WhatsAppAPIClient;
use App\Services\WhatsAppAPIResponseHandler;

class WhatsAppAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(WhatsAppAPIResponseHandler::class, function ($app) {
            return new WhatsAppAPIResponseHandler();
        });

        $this->app->singleton('whatsappapi', function ($app) {
            return new WhatsAppAPIClient(
                env('WHATSAPP_API_KEY', Setting::get('whatsapp_api_token')),
                env('WHATSAPP_BASE_URL', Setting::get('whatsapp_api_url')),
                $app->make(WhatsAppAPIResponseHandler::class)
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
