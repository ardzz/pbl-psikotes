@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card rounded-2 overflow-hidden">
        <div class="position-relative">
            <a href="javascript:void(0)"><img src="../../dist/images/blog/guides-pbl.png" class="card-img-top rounded-0 object-fit-cover" alt="..." height="440"></a>
            <span class="badge bg-white text-dark fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2 min Read</span>
            <img src="../../dist/images/profile/user-1.jpg" alt="" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Esther Lindsey">
        </div>
        <div class="card-body p-4">
            <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Panduan</span>
            <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Administrasi</span>
            <h2 class="fs-9 fw-semibold my-4">Panduan Mengerjakan Soal Psikotes <strong>MMPI-2</strong></h2>
            <div class="d-flex align-items-center gap-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-user"></i>
                    <span class="text-dark">Administrator</span>
                </div>
            </div>
        </div>
        <div class="card-body border-top p-4">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="fs-8 fw-semibold mb-3">1. Persiapkan Diri</h2>
                    <p class="mb-4">
                        Pastikan Anda beristirahat yang cukup sebelum mengikuti tes untuk memastikan konsentrasi yang baik. Bersiaplah untuk menjawab sejumlah besar pertanyaan dengan jujur dan tanpa ragu-ragu.
                    </p>
                    <h2 class="fs-8 fw-semibold mb-3">2. Anda memiliki 90 menit untuk mengerjakan test</h2>
                    <p class="mb-4">
                        Pastikan Anda dapat mengatur waktu untuk mengikuti tes untuk memastikan konsentrasi yang baik. Bersiaplah untuk menjawab soal test
                    </p>
                    <h2 class="fs-8 fw-semibold mb-3">3. Pahami Instruksi</h2>
                    <p class="mb-4">
                        Bacalah instruksi dengan seksama sebelum memulai tes. Pastikan Anda memahami format pertanyaan dan cara menjawabnya.
                    </p>
                    <h2 class="fs-8 fw-semibold mb-3">4. Jawablah Dengan Jujur</h2>
                    <p class="mb-4">
                        MMPI-2 adalah tes yang dirancang untuk mengukur berbagai aspek kepribadian. Jawablah pertanyaan dengan jujur, tanpa mencoba untuk memberikan jawaban yang Anda pikir diinginkan oleh pihak yang memberikan tes.
                    </p>
                </div>
                <div class="col-lg-6">
                    <h2 class="fs-8 fw-semibold mb-3">5. Jangan Terlalu Berpikir Lama</h2>
                    <p class="mb-4">
                        Jawablah pertanyaan sesuai dengan intuisi Anda. Hindari terlalu lama memikirkan jawaban, karena hal tersebut dapat mempengaruhi hasil tes.
                    </p>
                    <h2 class="fs-8 fw-semibold mb-3">6. Jangan Berbohong atau Memanipulasi</h2>
                    <p class="mb-4">
                        Tes ini dirancang untuk mendeteksi upaya untuk memanipulasi hasil, jadi jawablah dengan jujur dan konsisten. Hindari upaya untuk menggambarkan diri Anda dalam cahaya yang lebih baik atau lebih buruk dari kenyataan.
                    </p>
                    <h2 class="fs-8 fw-semibold mb-3">7. Tetaplah Tenang</h2>
                    <p class="mb-4">
                        Tetaplah tenang dan fokus saat menjawab pertanyaan. Jangan biarkan kecemasan atau tekanan memengaruhi cara Anda menjawab.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
