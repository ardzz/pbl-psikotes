@extends('layouts.dashboard')

@section('container-fluid')
    <div class="card rounded-2 overflow-hidden">
        <div class="position-relative">
            <a href="javascript:void(0)"><img src="../../dist/images/blog/about-mmpi2.png" class="card-img-top rounded-0 object-fit-cover" alt="..." height="440"></a>
            <span class="badge bg-white text-dark fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2 min Read</span>
            <img src="../../dist/images/profile/user-5.jpg" alt="" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Esther Lindsey">
        </div>
        <div class="card-body p-4">
            <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">MMPI-2</span>
            <h2 class="fs-9 fw-semibold my-4">Apa Itu <strong>MMPI-2</strong>?</h2>
            <div class="d-flex align-items-center gap-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="ti ti-user"></i>
                    <span class="text-dark">Administrator</span>
                </div>
            </div>
        </div>
        <div class="card-body border-top p-4">
            <h2 class="fs-8 fw-semibold mb-3">Title of the paragraph</h2>
            <p class="mb-3">
                But you cannot figure out what it is or what it can do. MTA web directory is the simplest way in which one can bid on a link, or a few links if they wish to do so. The link
                directory on MTA displays all of the links it currently has, and does so in alphabetical order, which makes it much easier for someone to find what they are looking for if it is
                something specific and they do not want to go through all the other sites and links as well. It allows you to start your bid at the bottom and slowly work your way to the top
                of the list.
            </p>
            <p class="mb-3">
                Gigure out what it is or what it can do. MTA web directory is the simplest way in which one can bid on a link, or a few links if they wish to do so. The link directory on MTA
                displays all of the links it currently has, and does so in alphabetical order, which makes it much easier for someone to find what they are looking for if it is something
                specific and they do not want to go through all the other sites and links as well. It allows you to start your bid at the bottom and slowly work your way to the top of the
            </p>
            <p class="text-dark mb-0"><strong>This is strong text.</strong></p>
            <p class="mb-0"><em>This is italic text.</em></p>
            <div class="border-top mt-7 pt-7">
                <h3 class="fw-semibold">Unorder list.</h3>
                <ul class="my-3 ps-4 text-dark">
                    <li class="d-flex align-items-center gap-2"><span class="p-1 bg-dark rounded-circle"></span> Gigure out what it is or</li>
                    <li class="d-flex align-items-center gap-2"><span class="p-1 bg-dark rounded-circle"></span> The links it currently</li>
                    <li class="d-flex align-items-center gap-2"><span class="p-1 bg-dark rounded-circle"></span> It allows you to start your bid</li>
                    <li class="d-flex align-items-center gap-2"><span class="p-1 bg-dark rounded-circle"></span> Gigure out what it is or</li>
                    <li class="d-flex align-items-center gap-2"><span class="p-1 bg-dark rounded-circle"></span> The links it currently</li>
                    <li class="d-flex align-items-center gap-2"><span class="p-1 bg-dark rounded-circle"></span> It allows you to start your bid</li>
                </ul>
            </div>
            <div class="border-top mt-7 pt-7">
                <h3 class="fw-semibold">Order list.</h3>
                <ol class="my-3 text-dark">
                    <li>Gigure out what it is or</li>
                    <li>The links it currently</li>
                    <li>It allows you to start your bid</li>
                    <li>Gigure out what it is or</li>
                    <li>The links it currently</li>
                    <li>It allows you to start your bid</li>
                </ol>
            </div>
            <div class="border-top mt-7 pt-7">
                <h3 class="fw-semibold">Quotes</h3>
                <div class="p-3">
                    <h6 class="mb-0 fs-4 fw-semibold"><i class="ti ti-quote fs-7"></i>Life is short, Smile while you still have teeth!</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
