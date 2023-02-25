@extends('faturhelper::layouts/admin/main')

@section('title', 'Kelola Hasil Tes')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2 mb-sm-0">Kelola Hasil Tes</h1>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
            <div class="card-body">
                @if(Session::get('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="alert-message">{{ Session::get('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th width="30"><input type="checkbox" class="form-check-input checkbox-all"></th>
                                <th>Member</th>
                                <th width="100">Tes</th>
                                <th width="80">Waktu Tes</th>
                                <th width="150">Project</th>
                                <th width="150">HRD</th>
                                <th width="60">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                            <tr>
                                <td align="center"><input type="checkbox" class="form-check-input checkbox-one"></td>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->test->name }}</td>
                                <td>
                                    <span class="d-none">{{ $result->created_at }}</span>
                                    {{ date('d/m/Y', strtotime($result->created_at)) }}
                                    <br>
                                    <small class="text-muted">{{ date('H:i', strtotime($result->created_at)) }} WIB</small>
                                </td>
                                <td>{{ $result->project->name }}</td>
                                <td>{{ $result->project->user->name }}</td>
                                <td align="center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.result.detail', ['id' => $result->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Lihat Detail"><i class="bi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $result->id }}" data-bs-toggle="tooltip" title="Hapus"><i class="bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>

<form class="form-delete d-none" method="post" action="{{ route('admin.result.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

@endsection

@section('js')

<script type="text/javascript">
    // DataTable
    Spandiv.DataTable("#datatable");

    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");
</script>

@endsection

@section('css')

<style>
    #datatable tr td {vertical-align: top!important;}
</style>

@endsection