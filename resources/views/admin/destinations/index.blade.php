@extends('admin.layouts.main')
@section('pageTitle',$pageTitle)
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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
                <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary"> Create Destination </a>
			</div>            
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <h6>{{ $pageTitle }}</h6>
                <hr>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Destination Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destinations as $index=>$destination )
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $destination->destination_name }}</td>
                                    <td>
                                        @if ($destination->status == 1)
                                            <span class="badge bg-success">Enabled</span>
                                        @else
                                            <span class="badge bg-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
											<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
											<ul class="dropdown-menu" style="margin: 0px;">
												<li><a class="dropdown-item" href="{{ route('admin.destinations.edit',$destination->uniqueid)}}">Edit </a>
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
                                <th>Category Name</th>
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
