<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/quiz-assets/assets/css/Bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="/quiz-assets/assets/css/stylo.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

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
    @yield('content')

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
