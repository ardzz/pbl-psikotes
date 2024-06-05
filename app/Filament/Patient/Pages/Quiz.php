<?php

namespace App\Filament\Patient\Pages;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use Awcodes\Shout\Components\Shout;
use Carbon\Carbon;
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
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class Quiz extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'fluentui-quiz-new-24-o';

    protected static string $view = 'filament.patient.pages.quiz';

    protected ?string $heading = '';

    public int $currentQuestion;

    public string $currentSchema = '';

    public string $content = '';

    public Exam $exam;
    public Carbon $deadline;

    public int $currentPageQuestion = 1;

    public Collection $questionList;

    public ?array $data = [];

    function __construct(){

    }

    public function mount()
    {
        $data = [];
        if(!auth()->user()->isPersonalInformationFullFilled()){
            $this->setActiveSchema('unfilled-profile');
        }
        elseif(auth()->user()->amIHaveUnassignedExam()){
            if (auth()->user()->amIUnstartedExam()){
                $this->exam = auth()->user()->getLatestExam();
                if(auth()->user()->getLatestExam()->approved){
                    $this->setActiveSchema('unstarted-quiz');
                }
                else {
                    $this->setActiveSchema('pending-quiz');
                }
            }
            else {
                $exam = auth()->user()->getUnfinishedExam();
                if($exam){
                    $expired = Carbon::parse($exam->start_time)->addMinutes(90);
                    $last_question = $exam->getLatestQuestion();
                    $this->deadline = $expired;
                    $this->content = $last_question->content;
                    $this->currentQuestion = $last_question->id;
                    $this->exam = $exam;
                    if($last_question->answer){
                        $data['answer'] = match ((bool) $last_question->answer->answer) {
                            true => 'T',
                            false => 'F',
                            null => '?'
                        };
                    }
                    $this->questionList = $exam->getQuestionList($this->currentPageQuestion);
                    $this->setActiveSchema('quiz');
                }else{
                    $this->setActiveSchema('unavailable');
                }
            }
        }
        else {
            $this->setActiveSchema('unavailable');
        }
        $this->form->fill($data);
    }

    public function quizSchema(){
        $this->currentSchema = 'quiz';
        return [
            Fieldset::make()->schema([
                View::make('filament.patient.pages.quiz-info')
                    ->viewData([
                        'questionList' => $this->questionList
                    ])
                    ->columnSpanFull(),
                Actions::make([
                    Action::make('list')
                        ->label('Daftar Soal')
                        ->color('primary')
                        ->modalContent(View::make('filament.patient.pages.questions'))
                        ->modalCancelAction(false)
                        ->modalSubmitAction(false)
                        ->extraModalFooterActions(fn (Action $action): array => [
                            $action->makeModalSubmitAction('next', ['next'])->label('Daftar Soal Selanjutnya'),
                            $action->makeModalSubmitAction('prev', ['prev'])->label('Daftar Soal Sebelumnya')
                        ])
                        ->action(function (array $data, array $arguments){
                            $act = $arguments[0];
                            if ($act == 'next'){
                                $this->currentPageQuestion++;
                                $this->questionList = $this->exam->getQuestionList($this->currentPageQuestion);
                                Notification::make('Soal Selanjutnya')
                                    ->body('Soal selanjutnya telah dimuat')
                                    ->success()
                                    ->send();
                            }elseif($act == 'prev'){
                                $this->currentPageQuestion--;
                                $this->questionList = $this->exam->getQuestionList($this->currentPageQuestion);
                                Notification::make('Soal Sebelumnya')
                                    ->body('Soal sebelumnya telah dimuat')
                                    ->success()
                                    ->send();
                            }
                        })
                    ->modalFooterActionsAlignment(Alignment::Center),
                    Action::make('finish')
                        ->label('Selesaikan Quiz')
                        ->requiresConfirmation()
                        ->color('danger')
                        ->action(function(array $data){
                            $exam = auth()->user()->getUnfinishedExam();
                            if($exam->update(['end_time' => now()])){
                                Notification::make('Quiz Selesai')
                                    ->body('Quiz telah selesai. Terima kasih telah mengerjakan.')
                                    ->success()
                                    ->send();
                                $this->redirect('/patient');
                            }
                        })
                ])->alignCenter()->columnSpanFull()
            ]),
            Section::make('Lembar Soal')
                ->icon('heroicon-o-academic-cap')
                ->schema([
                    View::make('filament.patient.pages.quiz-question')->columnSpanFull(),
                    Radio::make('answer')
                        ->id('answer')
                        ->options([
                            'T' => 'Benar',
                            'F' => 'Salah',
                            '?' => 'Tidak Tahu'
                        ])
                        ->hiddenLabel()
                        ->required()
                        ->inline()
                ])->footerActions([
                    Action::make('prev')
                        ->label('Previous')
                        ->action('prev')
                        ->color('gray'),
                    Action::make('next')->label('Next')
                        ->color('gray')
                        ->action(function(Get $get){
                            $this->next($this->data['answer']);
                        }),
                ])
                ->footerActionsAlignment(function(Request $request){
                    return Alignment::Start;
                })
            ->statePath('data'),
        ];
    }

    function unstartedQuizSchema(){
        return [
            Section::make('Memulai Quiz')
                ->icon('heroicon-o-academic-cap')
                ->schema([
                    View::make('filament.patient.pages.unstarted-quiz')->columnSpanFull(),
                    Actions::make([
                        Action::make('start')
                            ->label('Mulai Quiz')
                            ->color('warning')
                            ->action(function (){
                                if($this->exam->startExam()){
                                    Notification::make()
                                        ->title('Quiz Dimulai')
                                        ->body('Quiz telah dimulai. Semangat mengerjakan!')
                                        ->success()
                                        ->send();
                                    $this->redirect('/patient/quiz');
                                }else{
                                    Notification::make()
                                        ->title('Quiz Gagal Dimulai')
                                        ->body('Quiz gagal dimulai. Silahkan coba lagi.')
                                        ->danger()
                                        ->send();
                                }
                            })
                    ])->alignCenter()->columnSpanFull()
                ])
        ];
    }

    function pendingQuizSchema(){
        return [
            Section::make('Menunggu Persetujuan')
                ->icon('fas-question-circle')
                ->iconColor('warning')
                ->schema([
                    View::make('filament.patient.pages.pending-quiz'),
                    Actions::make([
                        Action::make('back')
                            ->label('Kembali Ke Dashboard')
                            ->color('gray')
                    ])->alignCenter()->columnSpanFull()
                ])
        ];
    }

    private function unavailableSchema()
    {
        return [
            Section::make('Quiz Tidak Tersedia')
                ->icon('bx-error')
                ->iconColor('danger')
                ->schema([
                    View::make('filament.patient.pages.unavailable-quiz')
                        ->id('question'),
                    Actions::make([
                        Action::make('request')
                            ->label('Ajukan Psikotes')
                            ->icon('iconsax-lin-send-2')
                            ->color('primary')
                            ->action(fn() => redirect('/patient/exams/create')),
                        Action::make('back')
                            ->label('Kembali Ke Dashboard')
                            ->icon('heroicon-s-home')
                            ->color('gray')
                            ->action(fn() => redirect('/patient/'))
                    ])
                ])
        ];
    }

    function unfilledProfile(){
        return [
            Section::make('Profil Belum Lengkap')
                ->iconColor('warning')
                ->schema([
                    Shout::make('so-important')
                        ->content('Profil Anda belum lengkap. Silahkan isi profil terlebih dahulu.')
                        ->color(Color::Red),
                    Actions::make([
                        Action::make('fill')
                            ->label('Isi Profil')
                            ->color('primary')
                            ->action(fn() => redirect('/patient/personal-information'))
                    ])->columnSpanFull()
                ])
        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema($this->getActiveSchema());
    }

    function next($input_answer): void
    {
        $input_answer = match ($input_answer) {
            'T' => true,
            'F' => false,
            default => null
        };
        $answer = Answer::where('question_id', $this->currentQuestion)->where('exam_id', $this->exam->id);
        if($answer->exists()){
            $answer->update([
                'answer' => $input_answer
            ]);
        }else{
            $answer = new Answer();
            $answer->exam_id = $this->exam->id;
            $answer->question_id = $this->currentQuestion;
            $answer->answer = $input_answer;
            $answer->save();
        }
        if ($this->currentQuestion >= 567){
            $this->exam->update(['end_time' => now()]);
            Notification::make('Quiz Selesai')
                ->body('Quiz telah selesai. Terima kasih telah mengerjakan.')
                ->success()
                ->send();
            redirect('/patient/quiz');
            $this->halt();
        }
        $nextQuestion = Question::where('id', $this->currentQuestion + 1)->first();
        $this->content = $nextQuestion->content;
        $this->currentQuestion++;
        if ($answers = $nextQuestion->answers($this->exam->id)->get()->first()) {
            $this->data['answer'] = match ($answers->answer) {
                1 => 'T',
                0 => 'F',
                null => '?'
            };
        }else{
            $this->data['answer'] = null;
        }
        $this->form->fill($this->data);
    }

    function prev(){
        if($this->currentQuestion != 1){
            $prevQuestion = Question::where('id', $this->currentQuestion - 1)->first();
            $this->content = $prevQuestion->content;
            $this->currentQuestion--;
            if ($answers = $prevQuestion->answers($this->exam->id)->get()->first()) {
                $this->data['answer'] = match ($answers->answer) {
                    1 => 'T',
                    0 => 'F',
                    null => '?'
                };
            }else{
                $this->data['answer'] = null;
            }
            $this->form->fill($this->data);
        }
    }

    private function getActiveSchema()
    {
        return match ($this->currentSchema) {
            'quiz' => $this->quizSchema(),
            'unstarted-quiz' => $this->unstartedQuizSchema(),
            'pending-quiz' => $this->pendingQuizSchema(),
            'unfilled-profile' => $this->unfilledProfile(),
            default => $this->unavailableSchema()
        };
    }

    private function setActiveSchema($schema)
    {
        $this->currentSchema = $schema;
    }

    function loadQuestion($id){
        $question = Question::where('id', $id)->first();
        if($question){
            $this->content = $question->content;
            if ($answers = $question->answers($this->exam->id)->get()->first()) {
                $this->data['answer'] = match ($answers->answer) {
                    1 => 'T',
                    0 => 'F',
                    null => '?'
                };
            }else{
                $this->data['answer'] = null;
            }
            $this->currentQuestion = $id;
            Notification::make('Memilih Soal')
                ->body('Soal telah dimuat')
                ->success()
                ->send();
            $this->form->fill($this->data);
        }
    }
}
