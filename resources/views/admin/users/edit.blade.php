@extends('admin.layouts.main')
@section('pageTitle',$pageTitle)
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $pageTitle }}</div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">{{ $pageTitle }}</h6>
                        <hr />                        
                    <!-- #All VALIDATION ERRORS -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            </div>
                        @endif                        
                        <form action="{{ route('admin.users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Fullname</label>
                                <input name="name" class="form-control" type="text" required value="{{ old('name',$user->name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Email Address</label>
                                <input name="email" class="form-control" type="text" required value="{{ old('email',$user->email) }}">
                            </div>
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Phone Number</label>
                                <input name="phone" class="form-control" type="text" required value="{{ old('phone',$user->phone) }}">
                            </div>
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="">Select Role</option>
                                    <option {{ $user->role === "admin" ? "selected": "" }} value="admin">Admin</option>
                                    <option {{ $user->role === "user" ? "selected": "" }} value="user">User</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Department" class="form-label">Department (For Non Admin Users)</label>
                                <select name="department_id" id="status" class="form-select" >
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                     <option {{ $user->department_id === $department->id ? "selected": "" }} value="{{ $department->id }}">{{ $department->destination_name}}</option>    
                                    @endforeach
                                    
                                </select>
                            </div>                            
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"  placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"  placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="">Select Option</option>
                                    <option {{ $user->status === "active" ? "selected": "" }} value="active">Enable</option>
                                    <option {{ $user->status === "inactive" ? "selected": "" }} value="inactive">Disable</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit"> Update <i class="bx bx-save"></i> </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
