@extends('faturhelper::layouts/admin/main')

@section('title', 'Edit Project')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Edit Project</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.project.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="name" class="form-control form-control-sm {{ $errors->has('name') ? 'border-danger' : '' }}" value="{{ $project->name }}" autofocus>
                            @if($errors->has('name'))
                            <div class="small text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Token <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="token" class="form-control form-control-sm {{ $errors->has('token') ? 'border-danger' : '' }}" value="{{ $project->token }}">
                            @if($errors->has('token'))
                            <div class="small text-danger">{{ $errors->first('token') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="input-group input-group-sm">
                                <input type="text" name="date" class="form-control form-control-sm {{ $errors->has('date') ? 'border-danger' : '' }}" autocomplete="off">
                                <span class="input-group-text {{ $errors->has('date') ? 'border-danger' : '' }}"><i class="bi-calendar2"></i></span>
                            </div>
                            @if($errors->has('date'))
                            <div class="small text-danger">{{ $errors->first('date') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Tes Tersedia <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            @foreach($tests as $test)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="tests[]" type="checkbox" value="{{ $test->id }}" id="tests-{{ $test->id }}" {{ in_array($test->id, $project->tests()->pluck('test_id')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tests-{{ $test->id }}">{{ $test->name }}</label>
                            </div>
                            @endforeach
                            @if($errors->has('tests'))
                            <div class="small text-danger">{{ $errors->first('tests') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-3"></div>
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                            <a href="{{ route('admin.project.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>

@endsection

@section('js')

<script>
    // Daterangepicker
    Spandiv.DateRangePicker("input[name=date]", {
        startDate: "{{ date('d/m/Y H:i', strtotime($project->date_from)) }}",
        endDate: "{{ date('d/m/Y H:i', strtotime($project->date_to)) }}"
    });
</script>

@endsection