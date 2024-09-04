@extends('admin.layouts.main')
@section('pageTitle', $pageTitle)
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $resource }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.files.index') }}" class="btn btn-primary">View All Files</a>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">{{ $pageTitle }}</h6>
                        <hr />
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.files.update', $file) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Title </label>
                                <input name="title" class="form-control" type="text" required
                                    value="{{ old('title', $file->title) }}" placeholder="Enter File Title">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">File Description</label>
                                <textarea name="description" class="form-control" required>{{ old('description', $file->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">File</label>
                                <input name="file_url" class="form-control" type="file" id="formFile">
                                @if (!empty($file->file_url))
                                    <div class="mt-2">
                                        <a class="btn btn-sm btn-small btn-info" href="{{ asset($file->file_url) }}"
                                            target="_blank">View Existing File</a>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit"> Update File <i class="bx bx-save"></i>
                                </button>
                                <button class="btn btn-danger" type="reset">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
