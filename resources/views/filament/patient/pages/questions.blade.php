<style>
    /* Styling untuk kotak soal */
    .soal-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .soal-box {
        width: 80px;
        height: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        font-size: 1.5rem;
    }

    .answered {
        background-color: #4ed36b; /* Hijau */
    }

    .unanswered {
        background-color: #F6E05E; /* Kuning */
    }
</style>
<div class="mt-2 mb-2">
    <div class="soal-group">
        <!-- Daftar Soal -->
        @php
        $questions = auth()->user()->getUnfinishedExam()->getQuestionList($this->currentPageQuestion);
        foreach ($questions as $question) {
            $status = ($question->answers != null) ? 'answered' : 'unanswered';
            echo '<a wire:click.prevent="loadQuestion(' . $question->id . ')" class="soal-box ' . $status . '">' . $question->id . '</a>';
        }
        @endphp
            <!-- Akhir Daftar Soal -->
    </div>
</div>
