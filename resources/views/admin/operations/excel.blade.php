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
            <div class="col-xl-6">                
                <div class="card">
                    
                    <div class="card-body">
                    <h6 class="mb-0 text-uppercase">{{ $pageTitle }}</h6>
                <hr/>                        
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
                        <form action="{{ route('admin.excel.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Mail File" class="form-label">Mail File</label>
                                <input name="mail_file" class="form-control" type="file" required>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit"> Save <i class="bx bx-save"></i> </button>
                                <button class="btn btn-danger" type="reset">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-xl-6">                
                <div class="card">
                    
                    <div class="card-body">
                    <h6 class="mb-0 text-uppercase">Sample Upload File</h6>
                <hr/>                        
                    <img src="{{ asset('templates/mail_upload_image.png') }}" style="width:100%;">   
                    <br>
                    <br>
                    <a href="{{ asset('templates/mail_upload_excel.xlsx') }}" target="_blank" class="btn btn-success"> Download Sample File Template</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
