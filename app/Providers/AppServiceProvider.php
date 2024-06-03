<?php

namespace App\Providers;

use App\Filament\Patient\Resources\ExamResource\Pages\CreateExam;
use App\Models\Setting;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
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
        TrustProxies::at('*');
        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
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

        try {
            $setting = Setting::all();

            $should_not_null = [
                'midtrans_client_key',
                'midtrans_server_key',
                'midtrans_environment',
            ];

            foreach ($should_not_null as $key) {
                if ($setting->where('name', $key)->first()->value == null) {
                    $temp = $setting->where('name', $key)->first();
                    $temp->value = $key == 'midtrans_environment' ? 'sandbox' : encrypt('PLACEHOLDER');
                    $temp->save();
                }
            }

            Config::$serverKey = decrypt($setting->where('name', 'midtrans_server_key')->first()->value);
            Config::$clientKey = decrypt($setting->where('name', 'midtrans_client_key')->first()->value);
            Config::$isProduction = $setting->where('name', 'midtrans_environment')->first()->value == 'production';

            Config::$isSanitized = true;
            Config::$is3ds = true;

            if (Config::$isProduction) {
                $snap_url = 'https://app.midtrans.com';
            } else {
                $snap_url = 'https://app.sandbox.midtrans.com';
            }
        }catch (\Exception $e){
            // do nothing
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
