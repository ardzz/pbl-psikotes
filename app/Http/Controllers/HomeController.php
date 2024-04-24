<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (auth()->user()->user_type == 3){
            $users = Exam::where('doctor_id', auth()->id())->get();
        }
        else {
            $users = Exam::all();
        }
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

    public function delete($id)
    {
        return view('exam.delete', ['exam' => Exam::find($id), 'doctors' => User::where('user_type', 3)->get()]);
    }

    public function addUser()
    {
        return view('exam.add-user');
    }

    public function guides()
    {
        return view('article.guides');
    }

    public function aboutMmpi2(){
        return view('article.about-mmpi2');
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
                if($exam){
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
                }else{
                    return view('quiz.unavailable');
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

    public function questionList(Request $request){
        $last_exam = Auth::user()->getLatestExam();
        $questions = $last_exam->getQuestions();
        if($request->user()->amIHaveUnassignedExam()) {
            if ($request->user()->amIUnstartedExam()) {
                if ($request->user()->getLatestExam()->approved) {
                    return view('exam.list-question', [
                        'questions' => $questions,
                        'exam' => $last_exam,
                        'unanswered' => $last_exam->getUnansweredQuestions(),
                        'null_answered' => $last_exam->getNullAnsweredQuestions()
                    ]);
                } else {
                    return view('quiz.unapproved', ['exam' => $request->user()->getLatestExam()]);
                }
            }else{
                return view('exam.list-question', [
                    'questions' => $questions,
                    'exam' => $last_exam,
                    'unanswered' => $last_exam->getUnansweredQuestions(),
                    'null_answered' => $last_exam->getNullAnsweredQuestions()
                ]);
            }
        }
        else{
            return view('quiz.unavailable');
        }
    }

    public function manageUser(){
        $users = User::all();
        return view('auth.user-list', ['users' => $users]);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if (!$user){
            return response()->redirectToRoute('manageUser');
        }
        return view('profile.edit-user', ['user' => $user]);
    }

    public function viewExamResult($id){
        $exam = Exam::where('user_id', auth()->user()->id)
            ->where('approved', 1)
            ->where('id', $id)
            ->whereNotNull('start_time')
            ->first();
        if (!$exam){
            return response()->redirectToRoute('dashboard');
        }
        return view('exam.result', [
            'exam' => $exam,
            'questions' => $exam->getQuestions(),
            'unanswered' => $exam->getUnansweredQuestions(),
            'null_answered' => $exam->getNullAnsweredQuestions()
        ]);
    }

}
