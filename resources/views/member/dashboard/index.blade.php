@extends('member-layouts/main')

@section('content')

<section>
    <div class="bg-theme-1 text-white" style="padding: 7em 0 8em 0; background-image:url('/assets/images/background/bg-tes.svg')">
        <div class="container">
            <div class="d-flex align-items-center rounded-2 shadow-sm p-3 bg-glass-light">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" width="70" height="70" style="background:url('/assets/images/default/default-man.png'); background-size:70px; background-position:center; border:2px solid #fff" class="me-3 rounded-circle">
                <div>
                    <p class="fw-bold text-capitalize mb-0">{{ Auth::user()->name }}</p>
                    <p class="mb-0">Selamat datang di Tes Online Psikologi.<br>Kamu dapat melakukan tes online dengan memilih project yang ada di bawah ini.</p>
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
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
          <div class="carousel-indicators mb-0">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active bg-dark rounded-circle" style="width:8px; height:8px" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class=" bg-dark rounded-circle" style="width:8px; height:8px" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class=" bg-dark rounded-circle" style="width:8px; height:8px" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex align-items-start py-3 px-3 border rounded-2">
                    <img width="50" class="me-3" src="https://tes.spandiv.xyz/assets/images/icon/study.png">
                    <p class="mb-0">Taukah kamu?<br> Tes psikologi mampu untuk memprediksi potensi pencapaian hasil belajar dan kemampuan kamu.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-start py-3 px-3 border rounded-2">
                    <img width="50" class="me-3" src="https://tes.spandiv.xyz/assets/images/icon/panic-attack.png">
                    <p class="mb-0">Taukah kamu?<br> Tes psikologi memberikan gambaran mengenai penyebab masalah yang mempengaruhi proses.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-start py-3 px-3 border rounded-2">
                    <img width="50" class="me-3" src="https://tes.spandiv.xyz/assets/images/icon/worker.png">
                    <p class="mb-0">Taukah kamu?<br> Tes psikologi bisa membantu perusahaan untuk memilih sumber daya manusia yang terbaik.</p>
                </div>
            </div>
          </div>
          <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <img width="40" src="https://tes.spandiv.xyz/assets/images/icon/next.png">
          </button>
        </div>  
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <div class="alert-message">{{ Session::get('message') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="w-100 my-3 rounded-1" style="height:3px; background-color:transparent"></div>
        <div class="heading">
            <p class="m-0 fw-bold">Daftar Project</p>
        </div>
        <div class="content">
            <div class="row justify-content-start">
                @foreach($projects as $project)
                <div class="col-md-6 d-flex align-items-stretch col-lg-4">
                    <a href="#" class="btn btn-md btn-block btn-outline-dark rounded-2 d-flex border py-3 my-2 w-100 btn-project" data-id="{{ $project->id }}">
                        <i class="h1 bi-clipboard me-3"></i>
                        <div class="text-start">
                            <p class="m-0 fw-bold">{{ $project->name }}</p>
                            <p class="m-0 small fw-normal"><i class="bi-calendar2"></i> Sampai {{ date('d/m/Y',strtotime($project->date_to)) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
    </section>
</div>
<div class="modal fade" id="modal-input-token" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{ route('member.project') }}">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input Token</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="token" class="form-control form-control-sm {{ $errors->has('token') ? 'border-danger' : '' }}" placeholder="Masukkan Token" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    $(document).on("click", ".btn-project", function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#modal-input-token").find("form").find("input[name=id]").val(id);
        Spandiv.Modal("#modal-input-token").show();
    });
</script>

@endsection