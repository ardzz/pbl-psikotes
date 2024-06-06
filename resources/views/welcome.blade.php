<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Favicons -->
    <link href="/dist/images/logos/4.1.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Medicio
    * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
    * Updated: Mar 17 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body data-aos-easing="ease-in-out" data-aos-duration="1000" data-aos-delay="0" class="">

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top topbar-scrolled">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
        <div class="align-items-center d-none d-md-flex">
            <i class="bi bi-clock"></i> Monday - Saturday, 8AM to 10PM
        </div>

    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center fixed-top header-scrolled">
    <div class="container d-flex align-items-center">

        <a class="logo me-auto"><img src="/dist/images/logos/4.png" class="dark-logo" width="200" alt=""></a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#cta">Services</a></li>
                <li><a class="nav-link scrollto active" href="#doctors">Doctors</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="/patient/login" class="appointment-btn scrollto">Login</a>
{{--        <a href="{{ route('register') }}" class="mx-3 btn-inverse-primary scrollto">Register</a>--}}

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<!-- ======= Hero Section ======= -->
<section id="hero">
    <!-- Slide 3 -->
    <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
        <div class="container" style="background-color: rgba(63, 187, 192, 1); padding: 20px; border-radius: 15px;">
            <h2 style="color: #fafcfc;">TES MMPI ONLINE</h2>
            <p style="color: #fafcfc;"><strong>Aplikasi Psikotes PBL Online menyediakan aplikasi khusus untuk pelaksanaan tes MMPI Online. Temukan kemudahan ikut tes online di Psikotes PBL Online. Dengan biaya terjangkau, sekali klik, anda dapat mengikuti tes. Laporan hasil tes realtime. </p>

{{--            <a href="{{ route('login') }}" class="btn-get-started scrollto mx-2" style="background-color: #297a7d;">Log In</a>--}}

        </div>
    </div>
</section><!-- End Hero -->




<main id="main">

    <!-- ======= Featured Services Section ======= -->
    <!-- End Featured Services Section -->

    <!-- ======= Cta Section ======= -->
    <!-- End Cta Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2>Mengenal Tes MMPI</h2>
            </div>

            <div class="row">
                <div class="col-lg-6 aos-init aos-animate" data-aos="fade-right">
                <p style="padding-top: 50px;">
                    <img src="assets/img/about.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content aos-init aos-animate" data-aos="fade-left">
                    <h3>Apa itu Tes MMPI?</h3>
                    <p class="fst-italic">
                        Tes MMPI adalah salah satu alat tes psikologi yang paling banyak digunakan untuk mengungkap kepribadian dan psikopatologi. Tes MMPI (Minnesota Multiphasic Personality Inventory) banyak digunakan untuk tujuan-tujuan klinis maupun melihat profile kepribadian secara lengkap. Karena fungsinya yang beragam, sehingga alat tes ini digunakan secara luas.
                    </p>
                    <ul>
                        <li>
                            <i class="fas fa-check text-primary"></i>
                            <span>Evaluasi pasien gangguan jiwa untuk membantu status kesehatan mentalnya.</span>
                        </li>
                        <li>
                            <i class="fas fa-check text-primary"></i>
                            <span>Penilaian kondisi pasien untuk menilai progres perawatan atau terapi</span>
                        </li>
                        <li>
                            <i class="fas fa-check text-primary"></i>
                            <span>Alat penelitian epidemilogi menggunakan kriteria kepribadian.</span>
                        </li>
                        <li>
                            <i class="fas fa-check text-primary"></i>
                            <span>Alat penelitian psikologi terutama menentukan perbedaan kriteria kepribadian.</span>
                        </li>
                        <li>
                            <i class="fas fa-check text-primary"></i>
                            <span>Deteksi kesehatan mental tersangka pidana (alat forensik kesehatan mental).</span>
                        </li>
                        <li>
                            <i class="fas fa-check text-primary"></i>
                            <span>Profiling kepribadian untuk penggunaan di organisasi.</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <!-- End Counts Section -->

    <!-- ======= Features Section ======= -->
    <!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->
    <!-- End Appointment Section -->

    <!-- ======= Departments Section ======= -->
    <!-- End Departments Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- End Testimonials Section -->
    <section id="cta" class="cta">
        <div class="container aos-init aos-animate" data-aos="zoom-in">

            <div class="section-title">
                <h2>Dapatkan layanan Tes MMPI Online</h2>
            </div>

            <div class="row">
                <div class="col-lg-6 pt-4 pt-lg-0 content aos-init aos-animate" data-aos="fade-right" style="text-align: center;">
                    <p style="font-size: 24px;">Aplikasi psikotes online dengan kemudahan akses</p>
                    <p style="text-align: center; padding-top: 50px; padding-bottom: 50px;">
                        Psikotes PBL Online merupakan sebuah platform aplikasi psikotes online terpercaya di Indonesia. Dengan beragam fitur aplikasi sehingga mendukung pelaksanaan tes secara online.
                    </p>
                    <p style="text-align: center; padding-bottom: 20px;">
                        Alat tes dan laporan hasil tes disusun sesuai dengan norma baku hasil penelitian. Telah dilakukan audit sistem oleh ahli berkompeten dibidangnya.
                        Laporan hasil tes akan didapatkan oleh peserta maksimal 1 x 24, dapat diunduh langsung didalam sistem.
                    </p>
                </div>
                <div class="col-lg-6 aos-init aos-animate" data-aos="fade-left">
                    <img src="assets/img/about.jpg" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section> <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2>Doctors</h2>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>SIMON PETRUS MATLY</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>WIBE DAVID RUMBIAK</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>YOHANES YULIUS KAMORI</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="assets/img/doctors/doctors-4.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>IVONNE APRILLIANTI SYARIF</h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Doctors Section -->

    <section class="faq-section ptb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-12">
                    <div class="section-heading mb-5 text-center">
                        <h2>Pertanyaan Seputar Tes MMPI</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-12">
                    <div class="accordion faq-accordion" id="accordionExample">
                        <div class="accordion-item box-border  active  mb-3">
                            <h5 class="accordion-header" id="faq-1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                    Waktu Pengerjaan Tes
                                </button>
                            </h5>
                            <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-1" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <i class="fas fa-question-circle"></i> Berapa lama waktu pengerjaan tes MMPI? <br>
                                    <i class="fas fa-plus-circle"></i> Waktu pengerjaan tes MMPI berkisar antara 45 menit hingga 90 menit bagi orang normal. Bagi orang yang mengalami gangguan psikologis, kemungkinan akan lebih dari waktu tersebut.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border">
                            <h5 class="accordion-header" id="faq-2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false">
                                    Jumlah soal Tes MMPI
                                </button>
                            </h5>
                            <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <i class="fas fa-question-circle"></i> Tes MMPI itu berapa jumlah soalnya? <br>
                                    <i class="fas fa-plus-circle"></i> Jumlah soal tes MMPI (MMPI-1) itu berjumlah 566 soal. Untuk tes MMP1-2 jumlah soalnya 567 soal. Sedangkan untuk tes MMPI 2/RF, jumlah soalnya sebanyak 338 soal.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-2">
                            <h5 class="accordion-header" id="faq-3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false">
                                    Cara Mengerjakan Tes MMPI Online
                                </button>
                            </h5>
                            <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <i class="fas fa-question-circle"></i> Bagaimana cara mengerjakan tes MMPI Online? <br>
                                    <i class="fas fa-plus-circle"></i> Cara mengerjakan tes MMPI Online adalah anda melakukan registrasi terlebih dahulu. Form registrasi akan dikirim via email anda secara langsung. Jika anda belum memiliki akun di NSD, silahkan registrasi terlebih dahulu secara gratis. Jika telah memiliki akun, anda tinggal login, untuk mengerjakan tes secara online.
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--faq section end-->
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">


    <div class="container">
        <div class="copyright">
            © Copyright <strong><span>PBL - Kelompok 3</span></strong> All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        </div>
    </div>
</footer><!-- End Footer -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
