@extends('admin.layouts.main')
@section('pageTitle', $pageTitle)
@section('content')
    <!--start page wrapper -->
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <a href="{{ route('admin.files.index') }}">
                    <div class="card radius-10 bg-gradient-deepblue">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">{{ $files }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-folder fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Files</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col">
                <a href="{{ route('admin.category.list') }}">
                    <div class="card radius-10 bg-gradient-orange">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">{{ $categories }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-user fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Sender Categories</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            {{-- <div class="col">
                <a href="{{ route('admin.destinations.list') }}">
                    <div class="card radius-10 bg-gradient-ohhappiness">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">{{ $destinations }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-box fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Receiver Destinations</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            <div class="col">
                <a href="{{ route('admin.users.all') }}">
                    <div class="card radius-10 bg-gradient-ibiza">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">{{ $users }}</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-user fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Users</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{-- @if (count($recentMails))
            <div class="card">
                <div class="card-body">
                    <h6>Recent Mails</h6>
                    <hr>
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
                                @foreach ($recentMails as $index => $mail)
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
        @endif --}}
    </div>
@endsection
