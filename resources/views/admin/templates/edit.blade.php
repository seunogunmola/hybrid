@extends('admin.layouts.main')
@section('pageTitle',$pageTitle)
@section('content')
<div class="page-wrapper">
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
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.mail.update',$mail->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Sender</label>
                                <input name="sender" class="form-control" type="text" required value="{{ old('sender',$mail->sender) }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Subject</label>
                                <input name="subject" class="form-control" type="text" required value="{{ old('subject',$mail->subject) }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Description</label>
                                <textarea name="description" class="form-control" required>{{ old('description',$mail->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Destination</label>
                                <input name="destination" class="form-control" type="text" required value="{{ old('destination',$mail->destination) }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Category</label>
                                <select name="category" id="" class="form-select" required>
                                    <option value="">Select Option</option>
                                    @foreach ($categories as $key=>$value)
                                        <option {{ $key==$mail->category ? "selected" : "" }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Date Received</label>
                                <input name="date" class="form-control" type="date" required value="{{ old('date',$mail->date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">File</label>
                                <input name="file" class="form-control" type="file" id="formFile" {{ isset($mail->file) ? "" : "required" }}>
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
</div>
@endsection
