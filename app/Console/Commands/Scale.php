<?php

namespace App\Console\Commands;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Console\Command;
use App\MMPI2\Scale as MMPI2Scale;
use Illuminate\Support\Str;

class Scale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        $scale = new MMPI2Scale(Exam::where('purpose', 'DUMMY_EXAM')->first());
        $method_excludes = [
            'CNSValidity',
            'toTF',
            '__construct',
            'make'
        ];

        $public_methods = array_filter(
            get_class_methods($scale),
            fn($method) => !in_array($method, $method_excludes)
        );

        $output = [];

        foreach ($public_methods as $method) {
            $output[] = [
                'method' => Str::snake($method),
                'result' => $scale->$method()
            ];
        }

        dd($output);
    }
}
