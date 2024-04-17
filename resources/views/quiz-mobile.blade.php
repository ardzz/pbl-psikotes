@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-0">
                <div class="card-body p-4">
                    <div class="border-bottom">
                        <div class="row">
                            <div class="col-12 col-sm-auto mb-2">
                                <ol class="breadcrumb font-size-16 mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="#" class="router-link-active">
                                            <strong class="router-link-active">
                                                <i class="uil uil-home-alt"></i>
                                                PSIKOTES MMPI-2
                                            </strong>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ env('APP_NAME') }}</li>
                                </ol>
                                <p class="text-muted text-truncate mb-0">
                                    <span>Deadline</span>
                                    <strong class="text-danger">{{ \Carbon\Carbon::parse($deadline)->format('d F Y H:i A') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="row">
                            <div class="col mb-2 mt-4">
                                <div class="d-flex justify-content-center">
                                    <h5 class="text-center mb-0" id="countdown_desc">Waktu Tersisa</h5>
                                    <h5 class="text-center mb-0 ms-2" id="countdown">00:00:00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="row">
                            <div class="col mb-3 mt-1">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-small btn-warning me-2">
                                        <i class="uil uil-edit me-1"></i>
                                        Selesaikan Ujian
                                    </button>
                                    <button class="btn btn-small btn-success">
                                        <i class="uil uil-trash-alt me-1"></i>
                                        Daftar Soal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">
            <div class="border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-auto mb-2">
                        <div class="d-flex justify-content-center">
                            <h3 class="text-truncate mb-2 btn btn-lg btn-light">
                                <span>No</span>
                                <strong class="text-dark" id="no_question">{{ $last_question->id }}</strong>
                                <span>dari</span>
                                <strong class="text-dark">568</strong>
                                <span>soal</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-4 mt-0">
                <div class="row">
                    <div class="col-12 mt-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="text mb-4">
                                    {{ $last_question->content }}
                                </h4>
                            </div>
                        </div>
                        <!-- answer option using button (3 options) and centering -->
                        <!-- make button each line vertically -->
                        <div class="mt-2 d-flex justify-content-center">
                            <div class="col-md-6">
                                <input type="hidden" id="question_id" value="{{ $last_question->id }}">
                                <button class="btn btn-light btn-lg w-100 mb-2" onclick="submit_answer('Yes')">YA</button>
                                <button class="btn btn-light btn-lg w-100 mb-2" onclick="submit_answer('Unknown')">TIDAK MENJAWAB</button>
                                <button class="btn btn-light btn-lg w-100 mb-2" onclick="submit_answer('No')">TIDAK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="card-footer border-top p-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-dark" onclick="prev_question()">Kembali</button>
                            <button class="btn btn-dark" onclick="next_question()">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script>
        let deadline_date = new Date('{{ $deadline }}').getTime();
        let x = setInterval(function() {
            let now = new Date().getTime();
            let t = deadline_date - now;
            let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((t % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = hours + ":" + minutes + ":" + seconds;
            if (t < 0) {
                clearInterval(x);
                // replace content countdown_desc
                $('#countdown_desc').replaceWith('<h3 class="text-danger">Waktu Habis</h3>');
                $('#countdown').remove();
            }
        }, 1000);
    </script>
    <script>
        function submit_answer(answer) {
            $.ajax({
                url: '{{ route('store_question') }}',
                type: 'POST',
                data: {
                    question_id: $('#question_id').val(),
                    answer: answer,
                    exam_id: '{{ $exam->id }}'
                },
                success: function(response) {
                    get_question(response.question_id, 1);
                },
                error: function(error) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.responseJSON.message
                    });
                }
            });
        }

        function get_question(question_id, index) {
            // convert to integer
            question_id = parseInt(question_id);
            index = parseInt(index);
            let next_question_id = question_id + index;
            $.ajax({
                url: '{{ url('/api/question') }}' + '/' + next_question_id,
                type: 'GET',
                success: function(response) {
                    $('#question').html(response.content);
                    $('#no_question').html(response.id);
                    $('#question_id').val(response.id);
                }
            });
        }

        function next_question() {
            current_question_id = $('#question_id').val();
            get_question(current_question_id, 1);
        }

        function prev_question() {
            current_question_id = $('#question_id').val();
            get_question(current_question_id, -1);
        }
    </script>
@endsection
