<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function exam()
    {
        $exams_db = Exam::all();
        $users = [];

        foreach ($exams_db as $exam) {
            if (!is_null($exam->end_date)) {
                $exam->status = 'Selesai';
                $exam->duration = $exam->start_date->diffForHumans($exam->end_date);
            } else {
                $exam->status = 'Berlangsung';
                $exam->duration = 'Sedang berlangsung';
                $exam->end_time = '<span class="text-danger">Belum selesai</span>';
            }
            $users[] = $exam;
        }

        return view('exam.list', compact('users'));
    }
}
