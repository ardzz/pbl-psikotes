var timerElement = document.getElementById("timer");
var totalTime = 60 * 60; // 1 jam
var timeRemaining = totalTime;

function updateTimer() {
    var hours = Math.floor(timeRemaining / 3600);
    var minutes = Math.floor((timeRemaining % 3600) / 60);
    var seconds = timeRemaining % 60;

    timerElement.textContent =
        (hours < 10 ? "0" : "") +
        hours +
        ":" +
        (minutes < 10 ? "0" : "") +
        minutes +
        ":" +
        (seconds < 10 ? "0" : "") +
        seconds;

    if (timeRemaining <= 0) {
        clearInterval(timerInterval);
        timerElement.textContent = "Waktu Habis";
        // Lakukan sesuatu saat waktu habis
    } else {
        timeRemaining--;
    }
}

var timerInterval = setInterval(updateTimer, 1000);

// next prev
var divs = $(".show-section fieldset");
var now = 0; // currently shown div
divs.hide().first().show(); // hide all divs except first

function next() {
    divs.eq(now).hide();
    now = now + 1 < divs.length ? now + 1 : 0;
    divs.eq(now).show(); // show next
    console.log(now);
    $(".stepSingle").eq(now).addClass("active");
    $(".bgColor").css("height", 25 * now + "%");
}
$(".prev").on("click", function () {
    divs.eq(now).hide();
    now = now > 0 ? now - 1 : divs.length - 1;
    divs.eq(now).show(); // show previous
    console.log(now);

    $(".option").addClass("animate");
    $(".option").removeClass("animateReverse");
    $(".stepSingle")
        .eq(now + 1)
        .removeClass("active");
    $(".bgColor").css("height", 25 * now + "%");
});

// quiz validation
var checkedradio = false;

function radiovalidate(stepnumber) {
    var checkradio = $("#step" + stepnumber + " input")
        .map(function () {
            if ($(this).is(":checked")) {
                return true;
            } else {
                return false;
            }
        })
        .get();

    checkedradio = checkradio.some(Boolean);
}

$(document).ready(function () {
    $(".stepSingle").eq(0).addClass("active");
    $(".bgColor").css("height", "25%");
    // check step1
    $("#step1btn").on("click", function () {
        radiovalidate(1);

        if (checkedradio == false) {
            (function (el) {
                setTimeout(function () {
                    el.children().remove(".reveal");
                }, 3000);
            })(
                $("#error").append(
                    '<div class="reveal alert alert-danger">Choose an option!</div>'
                )
            );

            radiovalidate(1);
        } else {
            $("#step1 .option").removeClass("animate");
            $("#step1 .option").addClass("animateReverse");
            setTimeout(function () {
                next();
            }, 900);
            // countresult(1);
        }
    });
    // check step2
    $("#step2btn").on("click", function () {
        radiovalidate(2);

        if (checkedradio == false) {
            (function (el) {
                setTimeout(function () {
                    el.children().remove(".reveal");
                }, 3000);
            })(
                $("#error").append(
                    '<div class="reveal alert alert-danger">Choose an option!</div>'
                )
            );

            radiovalidate(2);
        } else {
            $("#step2 .option").removeClass("animate");
            $("#step2 .option").addClass("animateReverse");
            setTimeout(function () {
                next();
            }, 900);
            // countresult(1);
        }
    });
    // check step3
    $("#step3btn").on("click", function () {
        radiovalidate(3);

        if (checkedradio == false) {
            (function (el) {
                setTimeout(function () {
                    el.children().remove(".reveal");
                }, 3000);
            })(
                $("#error").append(
                    '<div class="reveal alert alert-danger">Choose an option!</div>'
                )
            );

            radiovalidate(3);
        } else {
            $("#step3 .option").removeClass("animate");
            $("#step3 .option").addClass("animateReverse");
            setTimeout(function () {
                next();
            }, 900);
            // countresult(1);
        }
    });
    // check step4
    $("#sub").on("click", function () {
        radiovalidate(4);

        if (checkedradio == false) {
            (function (el) {
                setTimeout(function () {
                    el.children().remove(".reveal");
                }, 3000);
            })(
                $("#error").append(
                    '<div class="reveal alert alert-danger">Choose an option!</div>'
                )
            );

            radiovalidate(4);
        } else {
            showresult();
        }
    });
});
