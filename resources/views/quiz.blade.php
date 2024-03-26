<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/quiz-assets/assets/css/Bootstrap/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />

    <!-- Custom Style -->
    <link rel="stylesheet" href="/quiz-assets/assets/css/style.css" />

    <!-- animation -->
    <link rel="stylesheet" href="/quiz-assets/assets/css/animation.css" />

    <!-- Responsive -->
    <link rel="stylesheet" href="/quiz-assets/assets/css/responsive.css" />

    <!-- thankyou -->
    <link rel="stylesheet" href="/quiz-assets/assets/css/thankyou.css" />
  </head>
  <body>
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

    <!-- result -->
    <div class="loadingresult">
      <img src="/quiz-assets/assets/images/loading.gif" alt="loading" />
    </div>

    <div class="thankyou-page">
      <header class="thankyouheader">
        <h2>Quiz has been taken</h2>
      </header>
      <main class="thankyou-page-inner">
        <img src="/quiz-assets/assets/images/thankyou-check.png" alt="" />
        <span>Your answer has been submitted</span>
        <h1>Thankyou for taking Quiz</h1>
        <div class="subscribe">
          <input type="text" placeholder="Your Email" />
          <button type="button">subscribe now</button>
        </div>
      </main>
    </div>

    <div id="error"></div>

    <!-- Bootstrap JS -->
    <script src="/quiz-assets/assets/js/Bootstrap/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="/quiz-assets/assets/js/jQuery/jquery-3.7.1.min.js"></script>

    <!-- ThankyouJS -->
    <script src="/quiz-assets/assets/js/thankyou.js"></script>

    <!-- Custom JS -->
    <script src="/quiz-assets/assets/js/custom.js"></script>
  </body>
</html>
