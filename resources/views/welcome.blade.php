<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('includes.head')
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Psikotes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  <!-- Favicons --><link href="assets/img/favicon.png" rel="icon">
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
  <header id="header" class="fixed-top header-scrolled">
    <div class="container d-flex align-items-center">

      <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto active" href="#doctors">Doctors</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="{{ route('login') }}" class="appointment-btn scrollto">Login</a>
      <a href="{{ route('register') }}" class="mx-3 btn-inverse-primary scrollto">Register</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <!-- Slide 3 -->
    <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
          <div class="container">
            <h2>TES MMPI </h2>
            <p>Aplikasi Psikotes Online NS Development menyediakan aplikasi khusus untuk pelaksanaan tes MMPI Online. Temukan kemudahan ikut tes online di NS Development. Dengan biaya terjangkau, sekali klik, anda dapat mengikuti tes. Laporan hasil tes realtime.</p>
            
            <a href="#about" class="btn-get-started scrollto  mx-2">Daftar Sekarang</a>
            
            
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
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content aos-init aos-animate" data-aos="fade-left">
            <h3>Minnesota Multiphasic Personality Inventory</h3>
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
                                            <span>Sebuah tool untuk menilai gejala dalam menentukan perawatan yang sesuai.</span>
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
                                            <span>Evaluasi kesehatan mental orang tua.</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-check text-primary"></i>
                                            <span>Deteksi kesehatan mental tersangka pidana (alat forensik kesehatan mental).</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-check text-primary"></i>
                                            <span>Profiling kepribadian untuk penggunaan di organisasi.</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-check text-primary"></i>
                                            <span>Alat penilai kepribadian untuk posisi publik seperti polisi, tentara, pilot, pemadam kebakaran, calon bupati-gubernur-presiden, pejabat lain dan jabatan-jabatan lain yang penting untuk dilihat kesehatan jiwanya.</span>
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
          <h2>About Us</h2>    
      </div>

        <div class="row">
          <div class="col-lg-6 aos-init aos-animate" data-aos="fade-right">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content aos-init aos-animate" data-aos="fade-left">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
            </ul>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div>

      </div>
    </section>    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
          <h2>Doctors</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
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
                <h4>Walter White</h4>
                <span>Chief Medical Officer</span>
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
                <h4>Sarah Jhonson</h4>
                <span>Anesthesiologist</span>
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
                <h4>William Anderson</h4>
                <span>Cardiology</span>
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
                <h4>Amanda Jepson</h4>
                <span>Neurosurgeon</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Doctors Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
          <h2>Gallery</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="gallery-slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
          <div class="swiper-wrapper align-items-center" id="swiper-wrapper-106010f5555a105d8dc" aria-live="off" style="transition-duration: 0ms; transform: translate3d(-573.6px, 0px, 0px); transition-delay: 0ms;">
          <div class="swiper-slide" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="7 / 8" data-swiper-slide-index="6"><a class="gallery-lightbox" href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide" role="group" aria-label="8 / 8" style="width: 171.2px; margin-right: 20px;" data-swiper-slide-index="7"><a class="gallery-lightbox" href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="1 / 8" data-swiper-slide-index="0"><a class="gallery-lightbox" href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="2 / 8" data-swiper-slide-index="1"><a class="gallery-lightbox" href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide swiper-slide-prev" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="3 / 8" data-swiper-slide-index="2"><a class="gallery-lightbox" href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide swiper-slide-active" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="4 / 8" data-swiper-slide-index="3"><a class="gallery-lightbox" href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide swiper-slide-next" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="5 / 8" data-swiper-slide-index="4"><a class="gallery-lightbox" href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt=""></a></div><div class="swiper-slide" style="width: 171.2px; margin-right: 20px;" role="group" aria-label="6 / 8" data-swiper-slide-index="5"><a class="gallery-lightbox" href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt=""></a></div></div>
          <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 4" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 7"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 8"></span></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

      </div>
    </section><!-- End Gallery Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    

    <div class="container">
      <div class="copyright">
        © Copyright <strong><span>Medicio</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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
