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
                <h6 class="mb-0 text-uppercase">{{ $pageTitle }}</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
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
                        <form action="{{ route('admin.category.update',$category->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Category Name</label>
                                <input name="category_name" class="form-control" type="text" required value="{{ $category->category_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="Category Name" class="form-label">Category Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Select Option</option>
                                    <option {{ $category->status == "1" ? "selected": "" }} value="1">Enabled</option>
                                    <option{{ $category->status == "0" ? "selected": "" }} value="0">Disabled</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit"> Update <i class="bx bx-save"></i> </button>
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
