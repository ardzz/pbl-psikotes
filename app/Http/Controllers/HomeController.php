<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
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
        $users = Exam::all();
        return view('exam.list', compact('users'));
    }

    public function examHistory()
    {
        $users = Exam::where('user_id', auth()->id())->get();
        return view('exam.list-patient', compact('users'));
    }

    public function enrollment()
    {
        $doctors = User::where('user_type', 3)->get();

        return view('exam.add', compact('doctors'));
    }

    public function guides()
    {
        return view('guides');
    }

    public function aboutMmpi2(){
        return view('about-mmpi2');
    }

    public function mmpi2(Request $request){
        $agent = new Agent(userAgent: $request->header('User-Agent'));
        if($request->user()->amIHaveUnassignedExam()){
            if ($request->user()->amIUnstartedExam()){
                if($request->user()->getLatestExam()->approved){
                    return view('quiz.start');
                }
                else {
                    return view('quiz.unapproved', ['exam' => $request->user()->getLatestExam()]);
                }
            }
            else {
                $exam = $request->user()->getUnfinishedExam();
                $expired = Carbon::parse($exam->start_time)->addMinutes(90);
                $last_question = $exam->getLatestQuestion();
                if ($agent->isDesktop()){
                    return view('quiz.desktop', ['deadline' => $expired, 'last_question' => $last_question, 'exam' => $exam]);
                }
                elseif ($agent->isMobile()){
                    return view('quiz.mobile', ['deadline' => $expired, 'last_question' => $last_question, 'exam' => $exam]);
                }
                else{
                    return view('quiz.desktop', ['deadline' => $expired, 'last_question' => $last_question, 'exam' => $exam]);
                }
            }
        }
        else {
            return view('quiz.unavailable');
        }
    }

    public function requestMmpi2(){
        return view('exam.request');
    }

    public function approveExam($id){
        return view('exam.approve', ['exam' => Exam::find($id), 'doctors' => User::where('user_type', 3)->get()]);
    }
}
