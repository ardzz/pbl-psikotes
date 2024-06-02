<?php

namespace App\Filament\Pages;

use Coderflex\FilamentTurnstile\Forms\Components\Turnstile;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;

class Register extends \Filament\Pages\Auth\Register
{
    /**
     * @return array<int|string, string|Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Placeholder::make('')
                            ->content(new HtmlString('<img src="https://web.polines.ac.id/wp-content/uploads/2021/11/LOGO-POLITEKNIK-NEGERI-SEMARANG-2.png" alt="Polines" class="w-1/2 mx-auto mb-4">')),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        Turnstile::make('captcha')
                            ->label('Captcha')
                            ->columnSpanFull()
                            ->theme('auto'),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    // if you want to reset the captcha in case of validation error
    protected function throwFailureValidationException(): never
    {
        $this->dispatch('reset-captcha');

        parent::throwFailureValidationException();
    }
}
