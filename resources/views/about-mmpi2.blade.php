@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card rounded-2 overflow-hidden">
        <div class="position-relative">
            <a href="javascript:void(0)"><img src="../../dist/images/blog/about-mmpi2.png" class="card-img-top rounded-0 object-fit-cover" alt="..." height="400"></a>
            <span class="badge bg-white text-dark fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2 min Read</span>
            <img src="../../dist/images/profile/user-1.jpg" alt="" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Esther Lindsey">
        </div>
        <div class="card-body p-4">
            <span class="badge bg-info fs-2 rounded-4 py-1 px-2 lh-sm mt-3">MMPI-2</span>
            <h2 class="fs-9 fw-semibold my-4">Apa Itu <strong>MMPI-2</strong>?</h2>
            <div class="d-flex align-items-center gap-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-user"></i>
                    <span class="text-dark">Administrator</span>
                </div>
            </div>
        </div>
        <div class="card-body border-top p-4">
            <p class="mb-4">
                Minnesota Multiphasic Personality Inventory (MMPI) adalah tes psikologis yang paling banyak digunakan di dunia untuk membantu dalam penilaian dan diagnosis masalah mental dan emosional. MMPI-2 adalah versi yang diperbarui dari tes asli, yang dirilis pada tahun 1989.
            </p>
            <p class="mb-4">
                MMPI-2 terdiri dari serangkaian pertanyaan atau pernyataan yang harus dijawab oleh individu yang mengikuti tes. Tujuan dari tes ini adalah untuk membantu profesional kesehatan mental memahami kepribadian dan masalah psikologis yang mungkin dimiliki oleh individu tersebut.
            </p>
            <p class="mb-4">
                Tes ini mencakup berbagai area, termasuk kecenderungan terhadap depresi, kecemasan, gangguan kepribadian, serta pola pemikiran dan emosi lainnya. Hasil dari MMPI-2 dapat memberikan wawasan yang berharga bagi para profesional untuk membantu dalam merencanakan perawatan dan intervensi yang tepat.
            </p>
            <p class="mb-0">
                Penting untuk diingat bahwa MMPI-2 bukanlah tes yang menentukan segala-galanya, tetapi merupakan alat yang membantu dalam proses evaluasi klinis dan diagnosis masalah mental. Hasilnya harus dianalisis oleh profesional yang berpengalaman dalam psikodiagnostik.
            </p>
        </div>
    </div>
@endsection
