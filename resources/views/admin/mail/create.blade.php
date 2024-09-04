@extends('admin.layouts.main')
@section('pageTitle',$pageTitle)
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
                <a href="{{ route('admin.mail.index') }}" class="btn btn-primary">View All Mails</a>
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
                        <form action="{{ route('admin.mail.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Reference Number</label>
                                <input name="reference_no" class="form-control" type="text" required value="{{ old('reference_no') }}" placeholder="Enter Reference Number">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Sender</label>
                                <input name="sender" class="form-control" type="text" required value="{{ old('sender') }}" placeholder="Enter Sender Name">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Subject</label>
                                <input name="subject" class="form-control" type="text" required value="{{ old('subject') }}" placeholder="Enter Subject">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Description</label>
                                <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Destination</label>
                                <select name="destination_id" id="" class="form-select" required>
                                    <option value="">Select Option</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                                    @endforeach
                                </select>       
                                @if (!count($destinations))
                                    <a href="{{ route('admin.destinations.create') }}">Click Here to Create Destinations</a>                                   
                                @endif                         
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Category</label>
                                <select name="category_id" id="" class="form-select" required>
                                    <option value="">Select Option</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @if (!count($categories))
                                    <a href="{{ route('admin.category.create') }}">Click Here to Create Categories</a>                                   
                                @endif                                                         
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Date Received</label>
                                <input name="date" class="form-control" type="date" required value="{{ old('date') }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">File</label>
                                <input name="file" class="form-control" type="file" id="formFile" required>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Other Remarks</label>
                                <textarea name="remarks" class="form-control" >{{ old('remarks') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Date Minuted Out</label>
                                <input name="date_minuted" class="form-control" type="date"  value="{{ old('date_minuted') }}">
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit"> Save <i class="bx bx-save"></i> </button>
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
