<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Login;
use App\Filament\Pages\Register;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;

class PatientPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('patient')
            ->path('patient')
            ->login(Login::class)
            ->registration(Register::class)
            ->passwordReset()
            ->databaseNotifications()
            ->databaseNotificationsPolling('5s')
            ->sidebarCollapsibleOnDesktop()
            ->brandName('Kelompok Tiga')
            ->colors([
                'primary' => Color::Violet,
            ])
            ->plugins([
                //BreezyCore::make()->myProfile(),
                FilamentSocialitePlugin::make()
                    // (required) Add providers corresponding with providers in `config/services.php`.
                    ->setProviders([
                        'google' => [
                            'label' => 'Google',
                            // Custom icon requires an additional package, see below.
                            'icon' => 'fab-google',
                            // (optional) Button color override, default: 'gray'.
                            'color' => 'primary',
                            // (optional) Button style override, default: true (outlined).
                            'outlined' => false,
                        ],
                    ])
                    // (optional) Enable/disable registration of new (socialite-) users.
                    ->setRegistrationEnabled(true)
            ])
            ->discoverResources(in: app_path('Filament/Patient/Resources'), for: 'App\\Filament\\Patient\\Resources')
            ->discoverPages(in: app_path('Filament/Patient/Pages'), for: 'App\\Filament\\Patient\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Patient/Widgets'), for: 'App\\Filament\\Patient\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
