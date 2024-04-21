<?php

namespace App\Console\Commands;

use App\Models\Question;
use Illuminate\Console\Command;

class insertQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-question';

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
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $question_file = file_get_contents("indonesian_questions.json");
        $questions = json_decode($question_file, true);
        Question::insert(array_map(fn($question) => ['content' => $question], $questions));
    }
}
