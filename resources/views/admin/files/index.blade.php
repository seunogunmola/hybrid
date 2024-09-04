@extends('admin.layouts.main')
@section('pageTitle', $pageTitle)
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $resource }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $action }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.files.create') }}" class="btn btn-primary">Add File</a>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if (count($files) > 0)
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Uploaded By</th>
                                    <th>Date Uploaded</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($files as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a target="_blank" href="{{ route('admin.files.show', $file) }}"
                                                target="_blank">{{ $file->title }}</a>
                                        </td>
                                        <td>{{ $file->description }}</td>
                                        <td>{{ $file->owner->name }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                <ul class="dropdown-menu" style="margin: 0px;">
                                                    <li>
                                                        <a target="_blank" class="dropdown-item"
                                                            href="{{ route('admin.files.show', $file) }}"
                                                            target="_blank">View File</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.files.edit', $file) }}">Edit
                                                            File</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.files.destroy', $file) }}"
                                                            onclick="return confirm('Are You Sure?')">Delete File</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Uploaded By</th>
                                    <th>Date Uploaded</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <div>
                            <h4 class="alert alert-danger">No Working Files Uploaded</h4>
                            <a class="btn btn-sm btn-info" href="{{ route('admin.files.create') }}">Click Here to Upload
                                File</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
