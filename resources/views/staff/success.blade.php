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
                                        <table class="table mb-0 table-bordered table-striped">
                                            <tr style="background: black;color:white;">
                                                <td colspan="2">
                                                    Personal Details
                                                </td>
                                            </tr>                                              
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
                                            <tr style="background: darkgrey;color:white;">
                                                <td colspan="2">
                                                    Address
                                                </td>
                                            </tr>                                                 
                                            <tr>
                                                <td>Number/Street</td>
                                                <td>{{ $user->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Post Town</td>
                                                <td>{{ $user->post_town }}</td>
                                            </tr>
                                            <tr>
                                                <td>Number/Street</td>
                                                <td>{{ $user->post_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>CV</td>
                                                <td>
                                                    <a href="{{ asset($user->cv) }}" target="_blank">
                                                        Click Here to view CV File
                                                    </a>
                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>Supporting Statement</td>
                                                <td>{{ $user->supporting_statement }}</td>
                                            </tr>
                                            @if($user->employments)
                                            <tr style="background: black;color:white;">
                                                <td colspan="2">
                                                    Employment History
                                                </td>
                                            </tr>
                                                @foreach ($user->employments as $employments)
                                                <tr>
                                                    <td>Company Name</td>
                                                    <td>{{ $employments->company_name }}</td>
                                                </tr>                                                    
                                                <tr>
                                                    <td>Job Title</td>
                                                    <td>{{ $employments->job_title }}</td>
                                                </tr>                                                    
                                                <tr>
                                                    <td>Job Start Date </td>
                                                    <td>{{ $employments->job_start_date }}</td>
                                                </tr>                                                    
                                                <tr>
                                                    <td>Job Start Date</td>
                                                    <td>{{ $employments->job_end_date }}</td>
                                                </tr>         
                                                @endforeach
                                            @endif
                                            @if($user->references)
                                            <tr style="background: black;color:white;">
                                                <td colspan="2">
                                                    References
                                                </td>
                                            </tr>
                                                @foreach ($user->references as $reference)
                                                <tr>
                                                    <td>Referee Name</td>
                                                    <td>{{ $reference->referee_name }}</td>
                                                </tr>                                                    
                                                <tr>
                                                    <td>Company Name</td>
                                                    <td>{{ $reference->referee_company_name }}</td>
                                                </tr>                                                    
                                                <tr>
                                                    <td>Referee Job Title </td>
                                                    <td>{{ $reference->referee_job_title }}</td>
                                                </tr>                                                    
                                                <tr>
                                                    <td>Referee Email</td>
                                                    <td>{{ $reference->referee_email }}</td>
                                                </tr>         
                                                @endforeach
                                            @endif
                                            <tr style="background: black;color:white;">
                                                <td colspan="2">
                                                    Declarations
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td>Do you have any
                                                    adult cautions (simple or conditional) or spent
                                                    convictions that are not protected as defined by the Rehabilitation
                                                    of
                                                    Offenders Act 1974 (Exceptions) Order 1975 (Amendment) (England and
                                                    Wales) Order 2020?</td>
                                                <td>{{ $user->adult_cautions }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Are you barred from
                                                    working with children or vulnerable
                                                    adults?
                                                </td>
                                                <td>{{ $user->barred_from_children }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    subject to a child court protection proceeding or
                                                    order?
                                                </td>
                                                <td>{{ $user->child_court_protection }}</td>
                                            </tr>                                                                                                                                                                             
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    subject to an adult court protection proceeding or
                                                    order?
                                                </td>
                                                <td>{{ $user->adult_court_protection }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    refused/cancelled registration relating to
                                                    childcare?
                                                </td>
                                                <td>{{ $user->childcare_cancellation }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    refused/cancelled registration relating to
                                                    residential homes?
                                                </td>
                                                <td>{{ $user->residential_cancellation }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    prohibited from teaching children or from
                                                    childcare?
                                                </td>
                                                <td>{{ $user->teaching_prohibition }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    prohibited from caring for vulnerable
                                                    adults?
                                                </td>
                                                <td>{{ $user->adult_prohibition }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    barred or restricted from working by an
                                                    employer?
                                                </td>
                                                <td>{{ $user->barred_by_employer }}</td>
                                            </tr>                                                                                       
                                            <tr>
                                                <td>
                                                    Have you ever been
                                                    barred or restricted from working by a
                                                    professional body?
                                                </td>
                                                <td>{{ $user->barred_by_professional_body }}</td>
                                            </tr> 
                                            @if($user->declaration_details)                                                                                                                                                          
                                            <tr>
                                                <td>
                                                    If Yes to any of the
                                                    above, please give details
                                                </td>
                                                <td>{{ $user->declaration_details }}</td>
                                            </tr>                          
                                            @endif                                                                                     
                                        </table>
                                        <div class="mt-2">
                                            <button onclick="window.print()">
                                                Print
                                            </button>
                                        </div>
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
