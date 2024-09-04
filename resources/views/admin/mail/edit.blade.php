@extends('admin.layouts.main')
@section('pageTitle',$pageTitle)
@section('content')
    <div class="page-content">
        <!--end breadcrumb-->
        <div class="row">
        <div class="col-xl-9 mx-auto">

                <div class="card">
                    <div class="card-body">
                    <h6 class="mb-0 text-uppercase">{{ $pageTitle }}</h6>
                <hr />
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
                                <label for="formFile" class="form-label">Reference Number</label>
                                <input name="reference_no" class="form-control" type="text" required value="{{ old('reference_no',$mail->reference_no) }}" placeholder="Enter Reference Number">
                            </div>
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
                                <select name="destination_id" id="" class="form-select" required>
                                    <option value="">Select Option</option>
                                    @foreach ($destinations as $destination)
                                        <option {{ $mail->destination_id == $destination->id ? "selected" : "" }} value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                                    @endforeach
                                </select>                                   
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Category</label>
                                <select name="category_id" id="" class="form-select" required>
                                    <option value="">Select Option</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $mail->category_id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Other Remarks</label>
                                <textarea name="remarks" class="form-control" >{{ old('description',$mail->remarks) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Date Minuted Out</label>
                                <input name="date_minuted" class="form-control" type="date"  value="{{ old('date_minuted') }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value=""></option>
                                    <option {{ $mail->status === "0" ? "selected": "" }} value="0">Pending</option>
                                    <option {{ $mail->status === "1" ? "selected": "" }}  value="1">Away</option>
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
