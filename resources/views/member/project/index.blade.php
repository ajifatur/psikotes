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
        @foreach($project->tests as $test)
        <div class="col-auto">
            <a href="#" class="btn btn-md btn-block btn-outline-dark border-0 fw-bold py-3 my-3 btn-project" data-id="{{ $test->id }}">
                <i class="h1 bi-clipboard"></i>
                <p class="m-0 mb-2">{{ $test->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</section>

@endsection