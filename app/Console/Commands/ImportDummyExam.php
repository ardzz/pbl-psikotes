<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use Illuminate\Console\Command;

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
        $patient = User::where('user_type', 1)->get()->random();

        $this->info("Importing dummy exam for patient: {$patient->name}");

        if($patient->personal_information){
            $this->info('Gender type: ' . $patient->personal_information->sex);
        }else{
            $this->error("Patient doesn't have gender set, please set it first!");
            return;
        }

        $exam = Exam::create([
            'user_id' => $patient->id,
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

        $this->info(url('/login-as/' . $patient->id));
    }
}
