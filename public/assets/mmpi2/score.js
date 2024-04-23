function score() {
    document.body.style.cursor = "wait";
    let i, j, scale, tscale, q, n, s, rp;
    let k, rawscore, kscore, tscore, percent;
    let t_cnt, f_cnt, cs_cnt, pe;
    n = longform ? questions.length : 371;
    t_cnt = 0;
    f_cnt = 0;
    cs_cnt = 0;
    for (q = 1; q < n; ++q) {
        switch (ans[q]) {
            case "T":
                ++t_cnt;
                break;
            case "F":
                ++f_cnt;
                break;
            default:
                ++cs_cnt;
                break;
        }
    }
    --q;
    k = 0;
    pe = 0;
    for (i = 0; i < scales.length; ++i) {
        scale = scales[i];
        n = 0;
        rawscore = scale.base_score || 0;
        tscale = scale.t_scale;
        if (tscale) {
            tscale = (gender ? tscale.female : tscale.male);
        }
        if (scale.true_questions) {
            for (j = 0; j < scale.true_questions.length; ++j) {
                q = scale.true_questions[j];
                switch (ans[q]) {
                    case "T":
                        ++n;
                        ++rawscore;
                        break;
                    case "F":
                        ++n;
                        break;
                }
            }
        }
        if (scale.false_questions) {
            for (j = 0; j < scale.false_questions.length; ++j) {
                q = scale.false_questions[j];
                switch (ans[q]) {
                    case "F":
                        ++n;
                        ++rawscore;
                        break;
                    case "T":
                        ++n;
                        break;
                }
            }
        }
        if (scale.rin) {
            for (j = 0; j < scale.rin.length; ++j) {
                rp = scale.rin[j];
                if (ans[rp[0]] === rp[1] && ans[rp[2]] === rp[3]) {
                    rawscore += rp[4];
                }
                if (ans[rp[0]] !== "?" && ans[rp[2]] !== "?") {
                    ++n;
                }
            }
        }
        if (tscale !== undefined) {
            if (scale.name === "K") {
                k = rawscore;
            }
            if (scale.t_scale.k_correction) {
                kscore = k * scale.t_scale.k_correction + rawscore;
                kscore = Math.floor(kscore + 0.5);
                tscore = tscale[kscore];
            } else {
                kscore = undefined;
                tscore = tscale[rawscore];
            }
            percent = scale.rin ? (n * 100 / scale.rin.length) : (n * 100 / (scale.true_questions.length + j));
            scale.raw_score = rawscore;
            scale.t_score = tscore;
            scale.response = percent;
            switch (scale.name) {
                case "Hs":
                case "D":
                case "Hy":
                case "Pd":
                case "Pa":
                case "Pt":
                case "Sc":
                case "Ma":
                    pe += tscore;
                    break;
            }
        }
    }
    draw_chart("canvasVCS", "Validity and Clinical Scales Profile", [0, 1, 2, 3, 4, 5, 6, 7, undefined, 9, 10, 11, 12, gender ? 14 : 13, 15, 16, 17, 18, 19], true);
    draw_chart("canvasRCS", "Restructured Clinical Scales Profile", [92, 93, 94, 95, 96, 97, 98, 99, 100], true);
    draw_chart("canvasPSY", "PSY-5 Scales Profile", [101, 102, 103, 104, 105]);
    draw_chart("canvasCSP", "Content Scales Profile", [51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65], false);
    draw_chart("canvasSS", "Supplementary Scales Profile", [66, 67, 68, 75, 76, 77, 80, 72, 73, 74, 69, 70, 71, 78, 79]);
    document.body.style.cursor = "auto";
}

function radio_value(rb) {
    if (!rb) {
        return;
    }
    for (var i = 0; i < rb.length; i++) {
        if (rb[i].checked === true) {
            return rb[i].value;
        }
    }
}

function score_rb(form) {
    ans = [undefined];
    for (var i = 1; i < questions.length; ++i) {
        var rbv = radio_value(form.elements["Q" + i]);
        ans.push(rbv || "?");
    }
    update_score_text();
    score();
}

function update_rb() {
    var n, q;
    for (n = 1; n < questions.length; ++n) {
        q = document.forms.questions["Q" + n];
        switch (ans[n]) {
            case "F":
                q[0].checked = true;
                break;
            case "T":
                q[1].checked = true;
                break;
            default:
                q[0].checked = false;
                q[1].checked = false;
                break;
        }
    }
}

function score_text(anstext) {
    ans = [undefined];
    var n = 1;
    for (var i = 0; i < anstext.length; ++i) {
        if (anstext.charCodeAt(i) > 32) {
            var a;
            switch (anstext.charAt(i)) {
                case "T":
                case "t":
                case "Y":
                case "y":
                case "X":
                case "x":
                    a = "T";
                    break;
                case "F":
                case "f":
                case "N":
                case "n":
                case "O":
                case "o":
                    a = "F";
                    break;
                case "?":
                case "-":
                    a = "?";
                    break;
                default:
                    a = undefined;
                    break;
            }
            if (a) {
                ans.push(a);
                ++n;
            }
        }
    }
    for (; n < questions.length; ++n) {
        ans.push("?");
    }
    //update_rb();
    score();
}

function update_score_text() {
    var s = "";
    var q;
    for (q = 1; q < questions.length; ++q) {
        s += ans[q];
        if (q % 75 === 0) {
            s += "\n";
        }
    }
    document.forms.anstext.ata.value = s;
}