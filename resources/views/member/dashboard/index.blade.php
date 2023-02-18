@extends('member-layouts/main')

@section('content')

<section class="container py-2">
    @if(Session::get('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-message">{{ Session::get('message') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row justify-content-center">
        @foreach($projects as $project)
        <div class="col-auto">
            <a href="#" class="btn btn-md btn-block btn-outline-dark border-0 fw-bold py-3 my-3 btn-project" data-id="{{ $project->id }}">
                <i class="h1 bi-clipboard"></i>
                <p class="m-0 mb-2">{{ $project->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</section>
<!-- Modal -->
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
                    <input type="text" name="token" class="form-control form-control-sm {{ $errors->has('token') ? 'border-danger' : '' }}" placeholder="Masukkan Token" required autofocus>
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