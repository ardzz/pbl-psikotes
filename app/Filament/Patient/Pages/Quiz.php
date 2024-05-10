<?php

namespace App\Filament\Patient\Pages;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;
use Illuminate\Http\Request;

class Quiz extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.patient.pages.quiz';

    protected ?string $heading = '';

    public int $currentQuestion;

    public function mount()
    {
        $this->currentQuestion = 1;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Fieldset::make()->schema([
                View::make('filament.patient.pages.quiz-info')->columnSpanFull(),
                Actions::make([
                    Action::make('list')
                        ->label('Daftar Soal')
                        ->color('primary'),
                    Action::make('finish')
                        ->label('Selesaikan Quiz')
                        ->color('danger')
                ])->alignCenter()->columnSpanFull()
            ]),
            Section::make('Lembar Soal')
                ->icon('heroicon-o-academic-cap')
                ->schema([
                    Placeholder::make('')
                        ->id('question')
                        ->content(fake()->sentence(25)),
                    Radio::make('answer')
                        ->options([
                            'T' => 'Benar',
                            'F' => 'Salah',
                            '?' => 'Tidak Tahu'
                        ])
                        ->hiddenLabel()
                        ->required()
                        ->inline()
                ])->footerActions([
                    Action::make('prev')->label('Previous')
                        ->color('gray'),
                    Action::make('next')->label('Next')
                        ->color('gray')
                        ->action('next'),
                ])
                ->footerActionsAlignment(function(Request $request){
                    return Alignment::Start;
                    //dd($request);
                }),
        ]);
    }

    function next(): void
    {
        $this->currentQuestion++;
    }
}
