<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use Illuminate\Console\Command;
use Laravel\Prompts\MultiSelectPrompt;
use function Laravel\Prompts\multiselect;

class ImportDummyExam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-dummy-exam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $answers = "TTFTFFTFFFFFFTFTFFFTTTFFFTFFTFTFFTFTTTTFTFFFFTTTFTTTTFTTTFTFFTTFTTTFTTTFTFFTTFFFTTFFTFTTTFTTTFFFFTFFFFFFTFTTFTFFFFTFTTFTFFTFFFTTTTFFFFTFTFTFFFTFFFTFFTFFFTTTFTTFTFTTFTTFFFTTFFTTFTTTTFFFTTFFFTFTFFTTFFTFFFFTFFTFTFFFFTTFTFTFFTFTFTFFTFTTTFTTFTFFFFTFFFFFTTTFTFFTFTTTFFTTTTTTTFFFTFTTTTTFFFFTTFFFTFFFTFTFFFFFTFTFFTFTTTTFFTFTFFFTFFFFTTFFFTFFFFFFTFTFTFFTFFTTTFFFTFFFTFFFFTFTTFFTFFTTFTFTTTFTFFTTTTTFFTTFFTFFFFTTTFFTTFFTTFTTFFFFFTFTFFTTFFTFFFTTTTFFTFTTFTFFFTFFFTTTFTTFFTTFTTTTTFTFTFFTTTTTFFTTFTTFTTTFTFTTFFFFTFTFTTFTTTFFTFTFFTTTTTTTFFTFFTTFFTFTTFFFFFTFTFFFFFTFFTFFTTFFFTFFFTFTTTF";
        $patients = User::where('user_type', 1)->get();

        $select_user = \Laravel\Prompts\multiselect(
            label: 'Which user do you want to generate the exam for?',
            options: $patients->pluck('name', 'id')->toArray(),
            default: [$patients->random()->id],
        );

        $selected_user = User::find($select_user)->first();

        $exam = Exam::create([
            'user_id' => $selected_user->id,
            'purpose' => 'GENERATED_BY_SYSTEM',
            'doctor_id' => User::where('user_type', 3)->first()->id,
            'approved' => true,
            'start_time' => now(),
        ]);

        $answers = str_split($answers);
        $index = 1;
        foreach ($answers as $answer){
            Answer::create([
                'exam_id' => $exam->id,
                'question_id' => $index,
                'answer' => match ($answer){
                    "T" => true,
                    "F" => false
                }
            ]);
            $index++;
        }
        $exam->update([
            'end_time' => now()
        ]);

        $this->info(url('/login-as/' . $selected_user->id));
    }
}
