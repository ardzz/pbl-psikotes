<!-- Di dalam file print.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Psikologi - Cetak</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS jika diperlukan -->
    <style>

        /* Styling untuk kop surat */
        .letterhead {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center; /* Memusatkan secara horizontal */
            /* padding: 20px; */
            position: relative; /* Menjadikan posisi relatif untuk menempatkan garis */
            text-align: center; /* Memastikan teks terpusat */
        }

        .about-patient{
            display: flex;
            margin-left: 20px;
            align-items: center;
            /* justify-content: space-evenly;  */
            /* padding: 20px; */
            flex: 3;
            /* position: relative; Menjadikan posisi relatif untuk menempatkan garis */
            /* text-align: center; Memastikan teks terpusat */
        }
        .about-patient h2{
            font-weight: 150;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
        }

        .about-patient .nama{
            flex: 3;
        }
        .about-patient .umur{
            flex: 2;
        }

        .about-patient .pendidikan{
            flex: 2;
        }
        .sub-tittle{

            padding-right: 20px;
            margin-bottom: 10px;
        }

        .sub-tittle .isi{
            padding-right: 10px;
            font-weight: 130;
            padding-bottom: 0;
            margin-bottom: 0;
            padding-left: 48px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
        }

        .sub-tittle .sub-judul{
            font-weight: 600;
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            margin-left: 24px;
            margin-bottom: 0;
        }
        .sub-tittle .sub-judul2{
            font-weight: 600;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin-left: 16px;
            margin-bottom: 0;
        }
        .sub-tittle .sub-judul3{
            font-weight: 600;
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            margin-left: 0px;
            margin-bottom: 0;
        }
        .sub-tittle .sub-judul4{
            font-weight: 600;
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            margin-left: 8px;
            margin-bottom: 0;
        }
        .sub-tittle .sub-judul5{
            font-weight: 600;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            margin-left: 16px;
            margin-bottom: 0;
        }

        .sub-tittle li {
            padding: 0;
            padding-right: 10px;
            font-weight: 380;
            padding-left: 50px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
        }

        .sub-tittle .table-bordered,
        .sub-tittle .nilai{
            border-collapse: collapse;
            margin-left: 50px;
            margin-right: 50px;
            margin-top: 10;
            margin-bottom: 20px;
            width: 86%;
        }

        .sub-tittle .table-bordered th,
        .sub-tittle .table-bordered td {
            border: 0.0001px solid #6c757d;
            /* text-align: center; */
            font-family: 'Courier New', Courier, monospace;
            font-size: 9px;
        }
        .table-bordered .th-up {
            text-align: center;
        }
        .sub-tittle .nilai th,
        .sub-tittle .nilai td {
            border: 1px solid #6c757d;
            /* background-color: blue; */
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            font-size: 9px;
            font-weight: 500;
        }

        .sub-tittle p{
            padding-left: 50px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
        }
        .bab-duah{
            display: flex;
            flex: 2;
        }
        .kriteriaa{
            /* flex: ; */
        }
        .kriteriaa li{
            font-weight: 380;
            padding-left: 50px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
        .kriteriaa-info{
            flex: 1.4;
            font-family: 'Courier New', Courier, monospace;
            font-size: 9px;
            font-weight: 380;

        }
        .kriteriaa-info p{
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
        .letterhead h1 {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .letterhead img {
            width: 170px; /* Ukuran default */
            height: auto; /* Lebar akan menyesuaikan proporsi */
            margin-right: 20px; /* Margin untuk memberi jarak antara logo dan teks */
        }

        .sub-tittle .selesai {
            margin-left:0;
        }

        /* Penyesuaian jarak antara tanggal dan nama yang bertanda tangan */

        .bab-empat{
            display: flex;
        }
        .bab-empat .kriteria{
            flex: 3;

        }
        .bab-ghgsempat .kriteria-info{
            flex: 1;

        }
        .bab-empat .kriteria li{
            font-weight: 380;
            padding-left: 50px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 9.36px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
        .bab-empat .kriteria-info p{

            font-family: 'Courier New', Courier, monospace;
            font-size: 8.6px;
            font-weight: 380;
            margin-bottom: 1.3px;
            padding-bottom: 0;
        }

        .signature{
            margin-left: 3px;
        }
        .signature p{

        }
        @media print {
            .page-break  { display:block; page-break-before:always; }
            body {
                transform: scale(0.75);
            }
        }
    </style>
</head>
<body onload="window.print()">
<div class="card-body page-break">
    <div class="letterhead">
        <h1>Validity and Clinical Scales Profile</h1>
    </div>
    <div class="d-flex justify-content-center">
        <canvas id="canvasVCS" width="1" height="1"></canvas>
    </div>
</div>
<div class="card-body page-break">
    <div class="letterhead">
        <h1>Restructured Clinical Scales Profile</h1>
    </div>
    <div class="d-flex justify-content-center">
        <canvas id="canvasRCS" width="1" height="1"></canvas>
    </div>
</div>
<div class="card-body page-break">
    <div class="letterhead">
        <h1>Content Scales Profile</h1>
    </div>
    <div class="d-flex justify-content-center">
        <canvas id="canvasCSP" width="1" height="1"></canvas>
    </div>
</div>
<div class="card-body page-break">
    <div class="letterhead">
        <h1>Supplementary Scales Profile</h1>
    </div>
    <div class="d-flex justify-content-center">
        <canvas id="canvasSS" width="1" height="1"></canvas>
    </div>
</div>
<div class="card-body page-break">
    <div class="letterhead">
        <h1>PSY-5 Scales Profile</h1>
    </div>
    <div class="d-flex justify-content-center">
        <canvas id="canvasPSY" width="1" height="1"></canvas>
    </div>
</div>
<!-- Kop Surat -->
<div class="card-body page-break">
    <!-- Sesuaikan dengan desain kop surat yang diinginkan -->
    <div class="letterhead">
        <!-- <div>
                <img src="{{ asset('storage/logo_hitam_mepet.png') }}" alt="Logo" class="logo">
            </div> -->
        <h1>LAPORAN HASIL TES MMPI-2 (DEWASA)</h1>
        <!-- <div>
            <strong>Pemerintah Kota Semarang</strong>
            <p>Jl. Pandanaran No. XX, Semarang, Telp: (024) XXXXXXX</p>
        </div> -->
    </div>
</div>

<div class="">
    <div class="about-patient">
        <h2 class="nama">Nama : {{ $exam->user->name }} ({{ strtoupper($exam->user->personal_information->sex) }})</h2>

        <!-- <div class="umurpendidikan"> -->
        <h2 class="umur" style="margin-left: 30px; margin-right:-50px">Umur : {{ $exam->user->personal_information->age() }}</h2>
        <h2 class="pendidikan">Pendidikan : {{ $exam->user->personal_information->parseEducation() }}</h2>
        <!-- </div> -->

    </div>
    <h2 style="font-weight: 130; margin-left: 20px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px; margin-bottom:30px;">Keperluan : {{ $exam->purpose }}</h2>
</div>

<div class="sub-tittle">
    <h2 class="sub-judul">I. SIKAP TERHADAP TES</h2>
    <p class="isi">
        {{ strip_tags($exam->response_to_test) }}. Dengan demikian, skor validitas adalah {{ $exam->validity_score }}
    </p>
    <table class="table-bordered">
        <thead>
        <tr>
            <th class="th-up">Skor 0 (Nol)</th>
            <th class="th-up">Skor 1 (Satu)</th>
            <th class="th-up">Skor 2 (Dua)</th>
        </tr>
        <tr>
            <th>Tidak valid & tidak dapat di-interpretasi sama sekali</th>
            <th>Masih valid & dapat di-interpretasi dengan modifikasi</th>
            <th>Valid & dapat di-interpretasi sepenuhnya</th>
        </tr>
        </thead>
    </table>
</div>


<div class="sub-tittle">
    <h2 style="padding-left: 0px;" class="sub-judul2">
        II. INDEKS KAPASITAS MENTAL</h2>
    <p class="isi">Variabel kapasitas mental menunjukkan : </p>
    <div class="bab-duah">
        <div class="kriteriaa">
            <li><b>Potensi Kinerja</b>    : {{ $exam->work_performance }}</li>
            <li><b>Kemampuan Adaptasi</b> : {{ $exam->adaptability }}</li>
            <li><b>Kendala Psikologis</b> : {{ $exam->psychological_issue }}</li>
            <li><b>Perilaku Berisiko</b>  : {{ $exam->destructive_action }}</li>
            <li><b>Intergritas Moral</b>  : {{ $exam->moral_integrity }}</li>
        </div>
        <div class="kriteriaa-info">
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>
            <p>(Rentang skor: 0=besar,1=sedang,2=ringan)</p>
            <p>(Rentang skor: 0=besar,1=sedang,2=kecil)</p>
            <p>(Rentang skor: 0=tinggi,1=sedang,2=tinggi)</p>
        </div>
    </div>
    <p style="margin-bottom: 0;;">Sehingga Indeks Kapasitas Mental responden saat ini adalah {{ $exam->countMentalCapacity() }}</p>
    <table class="nilai">
        <thead>
        <tr>
            <th>0</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
        </tr>
        <tr>
            <th colspan="3">SANGAT BURUK</th>
            <th colspan="2">BURUK</th>
            <th colspan="2">SEDANG</th>
            <th colspan="2">BAIK</th>
            <th colspan="2">SANGAT BAIK</th>
        </tr>
        </thead>
    </table>
</div>

<div class="sub-tittle">
    <h2 style="padding-left: 9px;" class="sub-judul3">
        III. PROFIL KLINIS
    </h2>
    <p class="isi">
        {{ strip_tags($exam->clinical_profile) }} Dengan demikian, skor validitas adalah {{ $exam->validity_score }}

    </p>
</div>

<div class="sub-tittle">
    <h2 style="padding-left: 9px;" class="sub-judul4">
        IV. INDEKS KEPRIBADIAN DASAR
    </h2>
    <div class="bab-empat">
        <div class="kriteria">
            <!--
            $table->longText("openness")->nullable();
            $table->longText("conscientiousness")->nullable();
            $table->longText("extraversion")->nullable();
            $table->longText("agreeableness")->nullable();
            $table->longText("neuroticism")->nullable();
            -->
            <li>Keterbukaan Pikiran<b><i>(Openness)</i></b>    : {{ $exam->openness }}</li>
            <li>Keterbukaan Hati<b><i>(Conscientiousness)</i></b>    : {{ $exam->conscientiousness }}</li>
            <li>Keterbukaan terhadap Orang Lain<b><i>(Extraversion)</i></b>    : {{ $exam->extraversion }}</li>
            <li>Keterbukaan terhadap Kesepakatan<b><i>(Agreeableness)</i></b>    : {{ $exam->agreeableness }}</li>
            <li>Keterbukaan terhadap Tekanan<b><i>(Neuroticism)</i></b>    : {{ $exam->neuroticism }}</li>
        </div>
        <div class="kriteria-info">
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>
            <p>(Rentang skor: 0=kurang,1=sedang,2=besar)</p>

        </div>

    </div>
    <p style="margin-bottom: 0;">Sehingga <b><i>INDEKS "OCEAN" (Change DNA)</i></b> adalah {{ $exam->countPersonality() }}</p>
    <table class="nilai">
        <thead>
        <tr>
            <th>0</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
        </tr>
        <tr>
            <th colspan="3">SANGAT BURUK</th>
            <TH colspan="2">BURUK</TH>
            <TH colspan="2">SEDANG</TH>
            <TH colspan="2">BAIK</TH>
            <TH colspan="2">SANGAT BAIK</TH>
        </tr>
        </thead>
    </table>


    <div class="sub-tittle">
        <h2 style="padding-left: 9px;" class="sub-judul5">
            V. KESIMPULAN DAN SARAN
        </h2>
        <p class="isi">
            Dengan merujuk pada Skor Validitas, Indeks Kapasitas Mental dan Indeks Kepribadian Dasar serta Profil Klinis tersebut diatas,
        </p>
        <p>Kesimpulan : {{ strip_tags($exam->conclusion) }}</p>
    </div>
    <div class="signature">
        <p>Demikianlah laporan ini dibuat mengacu pada tes MMPI-2 ybs tanggal 28/11/2023 ... ........ (DI-ISI), Tanggal 28/11/2023</p>
        <br>
        <p>Pembuat Laporan,</p>
        <br>
        <img src="{{$exam->signature}}" alt="">
        <br>
        <p>(Dr.{{$exam->doctor->name}})  </p>

    </div>
</div>
</body>
<script type="text/javascript" src="/assets/mmpi2/scales.js"></script>
<script type="text/javascript" src="/assets/mmpi2/questions.js"></script>
<script type="text/javascript" src="/assets/mmpi2/canvastext.js"></script>
<script type="text/javascript" src="/assets/mmpi2/chart.js"></script>
<script type="text/javascript" src="/assets/mmpi2/score.js"></script>
<script type="text/javascript" src="/assets/mmpi2/utils.js"></script>
<script>
    longform=true;
    gender= {{ $exam->user->personal_information->gender == 'm' ? 1 : 0 }};
        chart_style=0;
    score_text('{{ $exam->analyze()->toTF() }}');
</script>
</html>
