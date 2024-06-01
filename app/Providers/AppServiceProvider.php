<?php

namespace App\Providers;

use App\Filament\Patient\Resources\ExamResource\Pages\CreateExam;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Facades\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentView::registerRenderHook('panels::body.end', fn(): string => Blade::render("@vite(['resources/css/app.css','resources/js/app.js'])"));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(env('APP_ENV') != 'local') {
            URL::forceScheme('https');
        }
        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            SecurityAdvisoriesCheck::new(),
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
                ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
            DatabaseConnectionCountCheck::new()
                ->warnWhenMoreConnectionsThan(50)
                ->failWhenMoreConnectionsThan(100)
        ]);

        Config::$serverKey = 'SB-Mid-server-hcUstBPhdDcDYLGpuW94srji';
        Config::$clientKey = 'SB-Mid-client-WmA9-eaewKwi1Yw-';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        if (Config::$isProduction){
            $snap_url = 'https://app.midtrans.com';
        }else{
            $snap_url = 'https://app.sandbox.midtrans.com';
        }

        FilamentView::registerRenderHook(
            PanelsRenderHook::SCRIPTS_BEFORE,
            fn (): string => Blade::render(<<<HTML
                    <script src="{$snap_url}/snap/snap.js" data-client-key="{{ \Midtrans\Config::\$clientKey }}"></script>
            HTML),
            scopes: [
                CreateExam::class
            ]
        );
    }
}
