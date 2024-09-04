@extends('admin.layouts.main')
@section('pageTitle',$pageTitle)
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
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index=>$user )
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        @if ($user->status === "active")
                                            <span class="badge bg-success"> {{ ucfirst($user->status) }}</span> 
                                        @else
                                            <span class="badge bg-danger">{{ ucfirst($user->status) }}</span> 
                                        @endif 
                                        
                                    </td>
                                    <td>
                                        <div class="dropdown">
											<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
											<ul class="dropdown-menu" style="margin: 0px;">
												<li><a class="dropdown-item" href="{{ route('admin.users.edit',$user->uniqueid)}}">Edit </a>
												</li>
												<li><a onclick="return confirm('Are You Sure?')"  class="dropdown-item" href="{{ route('admin.users.delete',$user->id) }}" id="#delete">Delete</a>
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
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
