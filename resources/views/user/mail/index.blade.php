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
                <a href="{{ route('admin.mail.create') }}" class="btn btn-primary">Add Mail</a>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <h4>Filter Mails</h4>
                <form action="{{ route('admin.mail.index') }}" method="get" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Sender</label>
                            <input type="text" class="form-control" name="sender">
                        </div>
                        <div class="col-md-3">
                            <label for="">Destination</label>
                            <select name="destination_id" class="form-select mb-3" aria-label="Default select example">
                                <option value="all">All</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Category</label>
                            <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                                <option value="all">All</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Status</label>
                            <select name="status" class="form-select mb-3" aria-label="Default select example">
                                <option value="all">All</option>
                                <option value="0">Pending</option>
                                <option value="1">Minuted Out</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary"> <i class="bx bx-filter"></i> Filter</button>
                    <a href="{{ route('admin.mail.index') }}" class="btn btn-success"> <i class="bx bx-refresh"></i>
                        Refresh</a>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sender</th>
                                <th style="width:50px;">Subject</th>
                                <!-- <th>Description</th> -->
                                <th>Destination</th>
                                <th>Category</th>
                                <th>Date Received</th>
                                <th>Date Minuted</th>
                                <!-- <th>File</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mails as $index => $mail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mail->sender }}</td>
                                    <td>
                                        <a href="{{ route('admin.mail.view', $mail->uniqueid) }}" target="_blank">
                                            {{ substr($mail->subject, 0, 50) }}...
                                        </a>
                                    </td>
                                    <!-- <td>{{ $mail->description }}</td>                                     -->
                                    <td>{{ $mail->destination->destination_name }}</td>
                                    <td>{{ $mail->category->category_name }}</td>
                                    <td>{{ $mail->date }}</td>
                                    <td>{{ $mail->date_minuted }}</td>
                                    <!-- <td> <a href="{{ asset($mail->file) }}" class="bx bx-envelope-open" title="View Mail" target="blank"></a></td> -->
                                    <td>
                                        @switch($mail->status)
                                            @case('0')
                                                <span class="badge bg-danger"> Pending </span>
                                            @break

                                            @case('1')
                                                <span class="badge bg-success"> Minuted Out </span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                            <ul class="dropdown-menu" style="margin: 0px;">
                                                <li><a target="_blank" class="dropdown-item"
                                                        href="{{ route('admin.mail.view', $mail->uniqueid) }}"
                                                        target="_blank">View Mail</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.mail.edit', $mail->uniqueid) }}">Edit
                                                        Mail</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.mail.delete', $mail->id) }}"
                                                        id="delete">Delete Mail</a>
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
                                <th>Sender</th>
                                <th>Subject</th>
                                <!-- <th>Description</th> -->
                                <th>Destination</th>
                                <th>Category</th>
                                <th>Date Received</th>
                                <th>Date Minuted</th>
                                <!-- <th>File</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
