@extends('member-layouts/main')

@section('content')

<section>
    <div class="bg-theme-1 text-white" style="padding: 7em 0 8em 0; background-image:url('/assets/images/background/bg-tes.svg')">
        <div class="container">
            <div class="d-flex align-items-center rounded-2 shadow-sm p-3 bg-glass-light">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" width="70" height="70" style="background:url('/assets/images/default/default-man.png'); background-size:70px; background-position:center; border:2px solid #fff" class="me-3 rounded-circle">
                <div>
                    <p class="fw-bold text-capitalize mb-0">{{ Auth::user()->name }}</p>
                    <p class="mb-0">Selamat datang di Tes Online Psikologi.<br>Kamu dapat melakukan tes online dengan memilih tes yang ada di bawah ini.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="bg-white position-relative" style="top:-4.5rem; border-radius: 1rem 1rem 0 0">
    <div class="d-flex justify-content-center py-3">
        <div style="height:5px; width:5rem; background-color:#ced4da" class="rounded-1"></div>
    </div>

    <section class="container">
        <div class="w-100 my-3 rounded-1" style="height:3px; background-color:transparent"></div>
        <div class="heading">
            <p class="m-0 fw-bold">Daftar Tes</p>
        </div>
        <div class="content">
            <div class="row justify-content-start">
                @foreach($project->tests()->orderBy('num_order','asc')->get() as $test)
                <div class="col-md-6 d-flex align-items-stretch col-lg-3">
                    <a href="#" class="btn btn-md btn-block btn-outline-dark rounded-2 d-flex border py-3 my-2 w-100">
                        <!-- <i class="h1 bi-clipboard me-3"></i> -->
                        <img width="60" class="me-3" src="{{ asset('assets/images/icon/'.$test->image.'.svg') }}">
                        <div class="text-start">
                            <p class="m-0 fw-bold">{{ $test->name }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
    </section>
</div>

<!-- <section>
    <div class="bg-theme-1" style="padding: 6em 0 2em 0">
        <main class="container text-center text-white">
            <h3 class="text-capitalize"><span id="demo"></span></h3>
            <p>Selamat datang <span class="fw-bold">{{ Auth::user()->name }}</span> di Tes Online Spandiv.</p>
        </main>
    </div>
</section>
<div class="custom-shape-divider-top-1617699401">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>
<section class="container py-2">
    @if(Session::get('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-message">{{ Session::get('message') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row justify-content-center">
        @foreach($project->tests as $test)
        <div class="col-auto">
            <a href="{{ route('member.test.index', ['path' => $test->code, 'project' => $project->id]) }}" class="btn btn-md btn-block btn-outline-dark border-0 fw-bold py-3 my-3 btn-project">
                <i class="h1 bi-clipboard"></i>
                <p class="m-0 mb-2">{{ $test->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</section> -->

@endsection