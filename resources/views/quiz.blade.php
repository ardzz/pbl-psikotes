@extends('layouts.layout-quiz')

@section('title', 'Quiz')

@section('content')
<div class="container">
            <div class="container-question">
                <div class="tittle-ujian">
                    <h1 class="">PSIKOTEST</h1>
                    <h2>No 13</h2>
                </div>
                <div class="question">
                    <h1>apa yang membuatmu marah?</h1>
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
                </div>
                <div class="button-group">
                    <button class="btn-sebelum">Sebelum</button>
                    <button class="btn-ragu">Ragu</button>
                    <button class="btn-setelah">setelah</button>
                </div>
            </div>
            <div class="container-number">
                <div class="title-nosoal">
                    <h2>Nomor soal</h2>
                </div>
                <div class="list-nosoal">
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                    <div class="no-satu">1</div>
                </div>

                <h3>hijau : aman</h3>
                <h3>hijau : aman</h3>
                <h3>hijau : aman</h3>
                <div class="btn-no-group">
                    <div class="btn-prev-nomor">
                        <a href="http:">Sebelumnya</a>
                    </div>
                    <div class="btn-next-nomor">
                        <a href="http:">Setelahnya</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
