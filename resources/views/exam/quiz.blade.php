@extends('layouts.layout-quiz')
@section('title', 'Quiz')

@section('content')
<div class="container ">
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
                    <label>Yes</label>
                </div>
                <div class="option animate delay-100">
                    <input type="radio" name="op3" value="Yes" />
                    <label>No</label>
                </div>
            </div>
        </div>
    <div id="toggle-id" class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>     
    <div class="button-group">
            <button class="btn-sebelum">Sebelum</button>
            <button class="btn-ragu">Ragu</button>
            <button class="btn-setelah">setelah</button>
        </div>
    </div> 

    <div id="menu-list" class="container-number">
        <div class=''>
            <div class="title-nosoal">
                <h2>Navigasi Soal</h2>
                <div class="waktu">
                    <h5>Sisa Waktu</h5>
                    <div class="timer" id="timer">00:00:00</div>
                </div>
            </div>
            <div class="list-nosoal">
                <div class="nomer nomer-hijau">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer nomer-merah">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
                <div class="nomer">1</div>
            </div>
            <div class="btn-no-group">
                <div class="btn-prev-nomor">
                    <a href="http:">&#9664; </a> <!-- Karakter panah kiri -->
                </div>
                <div class="btn-next-nomor">
                    <a href="http:">&#9654;</a> <!-- Karakter panah kanan -->
                </div>
            </div>
            <div class="keterangan">
                <p><span style="background-color: gray;"></span> : belum dikerjakan</p>
                <p><span style="background-color: green;"></span> : aman</p>
                <p><span style="background-color: red;"></span> : ragu</p>
            </div>
            
        </div>
</div>
</div>
@endsection