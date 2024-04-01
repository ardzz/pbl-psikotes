@extends('layouts.layout-quiz')

@section('title', 'Quiz')

@section('content')
<main class="overflow-hidden">
      <div class="stepCounter">
        <div class="stepSingle">
          <div class="stepBar"></div>

          <span>1</span>
        </div>
        <div class="stepSingle">
          <div class="stepBar"></div>
          <span>2</span>
        </div>
        <div class="stepSingle">
          <div class="stepBar"></div>

          <span>3</span>
        </div>
        <div class="stepSingle">
          <div class="stepBar"></div>

          <span>4</span>
        </div>
        <div class="bgColor"></div>
      </div>
      <div class="container">
        <section class="steps">
          <!-- Question Mark -->
          <img src="/quiz-assets/assets/images/QuestionHead.jpg" alt="QuestionMark" />
          <form
            novalidate
            onsubmit="return false"
            class="show-section"
            id="stepForm"
          >
            <!-- Step 1 -->
            <fieldset id="step1">
              <!-- Question -->
              <h1 class="question">
                Which Former Britishcolony was Given Back to China in 1997?
              </h1>

              <!-- Options -->
              <div class="options">
                <div class="option animate">
                  <input type="radio" name="op3" value="No" />
                  <label>No</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op3" value="Yes" />
                  <label>Yes</label>
                </div>
              </div>

              <!-- Next Prev -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-arrow-left"></i>Prev question
                </button>
                <button class="next" type="button" id="step1btn">
                  NEXT question<i class="fa-solid fa-arrow-right"></i>
                </button>
              </div>
            </fieldset>

            <!-- Step 2 -->
            <fieldset id="step2">
              <!-- Question -->
              <h1 class="question">
                Which Former Britishcolony was Given Back to China in 1997?
              </h1>

              <!-- Options -->
              <div class="options">
                <div class="option animate">
                  <input type="radio" name="op3" value="No" />
                  <label>No</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op3" value="Yes" />
                  <label>Yes</label>
                </div>
              </div>

              <!-- Next Prev -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-arrow-left"></i>Prev question
                </button>
                <button class="next" type="button" id="step2btn">
                  NEXT question<i class="fa-solid fa-arrow-right"></i>
                </button>
              </div>
            </fieldset>

            <!-- Step 3 -->
            <fieldset id="step3">
              <!-- Question -->
              <h1 class="question">
                Which Former Britishcolony was Given Back to China in 1997?
              </h1>

              <!-- Options -->
              <div class="options">
                <div class="option animate">
                  <input type="radio" name="op3" value="No" />
                  <label>No</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op3" value="Yes" />
                  <label>Yes</label>
                </div>
              </div>
              <!-- Next Prev -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-arrow-left"></i>Prev question
                </button>
                <button class="next" type="button" id="step3btn">
                  NEXT question<i class="fa-solid fa-arrow-right"></i>
                </button>
              </div>
            </fieldset>

            <!-- Step 4 -->
            <fieldset id="step4">
              <!-- Question -->
              <h1 class="question">
                Which Former Britishcolony was Given Back to China in 1997?
              </h1>

              <!-- Options -->
              <div class="options">
                <div class="option animate">
                  <input type="radio" name="op3" value="No" />
                  <label>No</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op3" value="Yes" />
                  <label>Yes</label>
                </div>
              </div>

              <!-- Next Prev -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-arrow-left"></i>Prev question
                </button>
                <button class="apply" type="button" id="sub">
                  Submit<i class="fa-solid fa-arrow-right"></i>
                </button>
              </div>
            </fieldset>
          </form>
        </section>
      </div>
    </main>
@endsection
