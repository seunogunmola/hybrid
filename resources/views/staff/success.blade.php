<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/simplebar/css/simplebar.css" rel="stylesheet') }}" />
    <link href="{{ asset('assets/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/metismenu/css/metisMenu.min.css') }} " rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }} "></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="my-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="mb-4 text-center">
                            <h3>Support Worker/ HCA Registration</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h4 class="">{{ $pageTitle }}</h4>
                                    </div>
                                    <div class="form-body">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <table class="table mb-0">
                                            <tr>
                                                <td>Pin</td>
                                                <td>
                                                    @foreach ($user->pin as $pin )
                                                        {{ $pin->pin }}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Firstname</td>
                                                <td>{{ $user->firstname }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lastname</td>
                                                <td>{{ $user->lastname }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
