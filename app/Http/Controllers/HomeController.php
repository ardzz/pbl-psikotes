<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->user_type == 1){
            $exam = Exam::where('user_id', auth()->id())->whereNull('end_date')->first();

        }
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
            } elseif (is_null($exam->expired_time)){
                $exam->status = 'Belum dimulai';
            } else {
                $exam->status = 'Berlangsung';
            }
            $users[] = $exam;
        }

        return view('exam.list', compact('users'));
    }

    public function enrollment()
    {
        $doctors = User::where('user_type', 3)->get();

        return view('exam.create', compact('doctors'));
    }

    public function myExam()
    {
        $exams_db = Exam::where('user_id', auth()->id())->get();
        $exams = [];

        foreach ($exams_db as $exam) {
            if (!is_null($exam->end_date)) {
                $exam->status = 'Selesai';
                $exam->duration = $exam->start_date->diffForHumans($exam->end_date);
            } elseif (is_null($exam->expired_time)){
                $exam->status = 'Belum dimulai';
            } else {
                $exam->status = 'Berlangsung';
            }
            $exams[] = $exam;
        }

        return view('exam.mine', compact('exams'));
    }

    public function guides(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('guides');
    }

    public function aboutMmpi2(){
        return view('about-mmpi2');
    }
}
