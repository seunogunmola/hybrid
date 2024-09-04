@extends('admin.layouts.main')
@section('pageTitle', $pageTitle)
@section('content')
    <div class="page-content">
        <!--start email wrapper-->
        <div class="email-wrapper" style="min-height:1200px!important;">
            <div class="">
                <div class="email-read-box p-3">
                    <h4>{{ $action }}</h4>
                    <hr>
                    <div style="margin-bottom: 10px;">
                        <a target="_blank" href="{{ asset($file->file_url) }}" class="btn btn-sm btn-info">Download <i
                                class="bx bx-download>">
                            </i> </a>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <td>Tile</td>
                            <td>{{ $file->title }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $file->description }}</td>
                        </tr>
                        <tr>
                            <td>Uploaded By</td>
                            <td>{{ $file->owner->name }}</td>
                        </tr>
                        <tr>
                            <td>Date Uploaded</td>
                            <td>{{ $file->created_at }}</td>
                        </tr>

                    </table>
                    <br>
                    <div class="">
                        File:
                        <hr>
                        <iframe style="width:100%;height:1200px;" src="{{ asset($file->file_url) }}"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
