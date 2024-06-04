<?php

namespace App\MMPI2;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\User;
use Exception;

class Scale
{
    protected Exam $exam;
    protected User $user;
    protected float $k_raw_score;
    protected array $grades;
    protected string $gender;

    /**
     * @throws Exception
     */
    public function __construct(Exam $exam)
    {
        if(!$exam->user->isPersonalInformationFullFilled()){
            throw new Exception("{$exam->user->name} personal information is not full filled");
        }
        $this->exam = $exam;
        $this->user = $exam->user;
        $this->gender = $this->user->personal_information->sex == 'm' ? 'male' : 'female';
        $this->load_scale();
    }

    /**
     * @throws Exception
     */
    protected function load_scale(): void
    {
        $file = storage_path('scales.json');
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $this->grades = json_decode($json, true);
        }
        else {
            throw new Exception('File scales.json not found');
        }
    }

    protected function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @throws Exception
     */
    static function make(Exam $exam): Scale
    {
        return new Scale($exam);
    }

    public function toTF(): string
    {
        $answers = Answer::where('exam_id', $this->exam->id)->get();
        $result = [];
        foreach ($answers as $answer) {
            $result[] = match ((bool) $answer->answer) {
                true => 'T',
                false => 'F',
                default => '?',
            };
        }
        return implode('', $result);
    }

    public function CNSValidity(): bool
    {
        if($this->exam->getUnansweredQuestions()->count() <= 30){
            return $this->exam->getNullAnsweredQuestions()->count() <= 30;
        }
        return false;
    }

    /**
     * @throws Exception
     */
    protected function getGradesValue(){
        $key = $this->getMethodNameToGradeKey();
        foreach ($this->getGrades() as $scale) {
            if ($scale['title'] == $key) {
                return $scale;
            }
        }
        throw new Exception("Grade {$key} not found in scales.json");
    }

    /**
     * @throws Exception
     */
    protected function getScaleValue(string $key){
        $grades = $this->getGradesValue();
        foreach ($grades['items'] as $scale) {

            if ($scale['name'] == $key) {
                return $scale;
            }
        }
        throw new Exception("Scale {$key} not found in scales.json");
    }

    /**
     * @throws Exception
     */
    protected function getScaleKeys(): array
    {
        $grades = $this->getGradesValue();
        $keys = [];
        foreach ($grades['items'] as $scale) {
            $keys[] = $scale['name'];
        }
        return $keys;
    }

    protected function TScore($scale, $raw_score){
        if(array_key_exists('tScores', $scale)){
            if (array_key_exists($this->gender, $scale['tScores'])){
                $tscore = $scale['tScores'][$this->gender];
                if (array_key_exists('scoreOffsets', $scale)) {
                    $raw_score -= $scale['scoreOffsets'][$this->gender];
                }
                return $tscore[min(max(0, $raw_score), count($tscore) - 1)];
            }
        }
        return null;
    }

    /**
     * @throws Exception
     */
    public function ResponseInconsistencyScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function ValidityScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function ClinicalScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function RcScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function ContentScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function GeneralizedEmotionalDistressScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function BroadPersonalityCharacteristicScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function BehaviorDyscontrolScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function KossButcherCriticalItems(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function LacharWrobelCriticalItems(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function GenderRoleScales(): array
    {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    public function PersonalityPsychopathologyFive(): array {
        return $this->interprate();
    }

    /**
     * @throws Exception
     */
    protected function interprate(){
        $keys = $this->getScaleKeys();
        if (in_array('VRIN', $keys)){
            $rawScoreType = 'calculateConsistencyRawScore';
        }else{
            $rawScoreType = 'calculateNonConsistencyRawScore';
        }
        $scales = [];
        foreach ($keys as $key) {
            $scale = $this->getScaleValue($key);
            $raw_score = $this->$rawScoreType($scale);
            $scales[$key] = $this->parsingScaleOutput($raw_score, $scale);
        }

        return $scales;
    }

    protected function KScore($scale, $raw_score): ?float
    {
        if (array_key_exists('kCorrection', $scale)) {
            $k_correction = $scale['kCorrection'];
            $k_score = $this->k_raw_score * $k_correction + $raw_score;
            return floor($k_score + 0.5);
        }
        return null;
    }

    protected function parsingScaleOutput($raw_score, $scale): array
    {
        $output = [
            'raw_score' => $raw_score,
            't_score' => $this->TScore($scale, $raw_score),
            'k_score' => $this->KScore($scale, $raw_score),
        ];

        if (array_key_exists('subScales', $scale)) {
            $output['subScales'] = [];
            foreach ($scale['subScales'] as $subScale) {
                $subScaleRawScore = $this->calculateNonConsistencyRawScore($subScale);
                $output['subScales'][$subScale['name']] = [
                    'raw_score' => $subScaleRawScore,
                    't_score' => $this->TScore($subScale, $subScaleRawScore),
                ];
            }
        }

        return $output;
    }

    protected function calculateNonConsistencyRawScore($scale){
        $exam_answers = Answer::where('exam_id', $this->exam->id)->first();
        $score = $scale['baseScore'] ?? 0;
        foreach ($scale['answers'] as $scale_answers) {
            $expected_answer = (bool) $scale_answers[1];
            $answer = (bool) $exam_answers->where('question_id', $scale_answers[0])->first()->answer;
            if ($expected_answer == $answer) {
                $score++;
            }
        }
        if ($scale['name'] == 'K') {
            $this->k_raw_score = $score;
        }
        return $score;
    }

    protected function calculateConsistencyRawScore($scale)
    {
        $exam_answers = Answer::where('exam_id', $this->exam->id)->first();
        $score = $scale['baseScore'] ?? 0;

        foreach ($scale['answers'] as $scale_answers) {
            $expected_answer = [
                (bool) $scale_answers[1],
                (bool) $scale_answers[3]
            ];
            $answer = [
                (bool) $exam_answers->where('question_id', $scale_answers[0])->first()->answer,
                (bool) $exam_answers->where('question_id', $scale_answers[2])->first()->answer
            ];
            if ($expected_answer == $answer) {
                $score += $scale_answers[4];
            }
        }
        return $score;
    }

    protected function getMethodNameToGradeKey(): array|string|null
    {
        $name = debug_backtrace()[4]['function'];
        return preg_replace('/(?<!^)[A-Z]/', ' $0', $name);
    }

}
