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
        <div class=" align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="mb-4 text-center">
                            <h3>
                                Support Worker/ HCA Registration
                            </h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{ route('staff.form.store') }}"
                                            enctype="multipart/form-data">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Upload Your CV</label>
                                                <input type="file" name="cv_file" class="form-control"
                                                    id="inputLastName" placeholder="" required value="">
                                            </div>
                                            <h5>Your Suitability</h5>
                                            <p>
                                                Describe your experience, skills and what you can personally offer.
                                                We will score your information against the relevant points in person
                                                specification for the job. Use examples from your work, student
                                                projects or placements, home life, social activities, or volunteering,
                                                to
                                                highlight relevant skills.
                                            </p>
                                            <div class="col-sm-12">
                                                <label for="inputFirstName" class="form-label">Supporting
                                                    Statement</label>
                                                <textarea name="supporting_statement" class="form-control" id="" cols="30" rows="5" required>{{ old('supporting_statement') }}</textarea>
                                            </div>
                                            <h5>Employment History</h5>
                                            <p>
                                                Provide details of your employment, starting with your most recent
                                                work first.
                                            </p>
                                            @php
                                                // If old input exists, use it; otherwise, provide a single empty input
                                                $jobDetails = old('job_details', ['']);
                                            @endphp

                                            <div id="job-fields">
                                                <!-- First set of job fields -->
                                                <div class="job-entry">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label for="job_title" class="form-label">Job Title</label>
                                                            <input type="text" name="job_title[]" class="form-control" placeholder="Job Title" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="company_name" class="form-label">Company Name</label>
                                                            <input type="text" name="company_name[]" class="form-control" placeholder="Company Name" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="job_start_date" class="form-label">Employment Start Date</label>
                                                            <input type="date" name="job_start_date[]" class="form-control" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="job_end_date" class="form-label">Employment End Date</label>
                                                            <input type="date" name="job_end_date[]" class="form-control" required>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="job_details" class="form-label">Job Details</label>
                                                            <textarea name="job_details[]" class="form-control" cols="30" rows="5" placeholder="Job Details"></textarea>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                            
                                            <!-- Add New Button -->
                                            <div class="col-6">
                                                <button type="button" id="add-job-btn" class="btn btn-success">Add New Job</button>
                                            </div>
                                            
                                            
                                            
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    document.getElementById('add-job-btn').addEventListener('click', function () {
                                                        alert('Add New Job');
                                                        // Get the job fields container
                                                        var container = document.getElementById('job-fields');
                                            
                                                        // Clone the first set of job fields
                                                        var jobEntry = document.querySelector('.job-entry').cloneNode(true);
                                            
                                                        // Clear the input values in the cloned node
                                                        var inputs = jobEntry.querySelectorAll('input');
                                                        var textareas = jobEntry.querySelectorAll('textarea');
                                            
                                                        inputs.forEach(function (input) {
                                                            input.value = ''; // Clear the value
                                                        });
                                            
                                                        textareas.forEach(function (textarea) {
                                                            textarea.value = ''; // Clear the value
                                                        });
                                            
                                                        // Append the cloned node to the container
                                                        container.appendChild(jobEntry);
                                                    });
                                                });
                                            </script>
                                            

                                            <h5>References</h5>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee 1 Name
                                                </label>
                                                <input type="text" name="referee_name[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Name" required
                                                    value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Company Name</label>
                                                <input type="text" name="referee_company_name[]"
                                                    class="form-control" id="inputEmailAddress"
                                                    placeholder="Company Name" required value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee Job
                                                    Title</label>
                                                <input type="text" name="referee_job_title[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Job Title" required
                                                    value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee
                                                    Email</label>
                                                <input type="email" name="referee_email[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Email" required
                                                    value="">
                                            </div>
                                            <hr>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee 2
                                                    Name</label>
                                                <input type="text" name="referee_name[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Name" required
                                                    value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Company Name</label>
                                                <input type="text" name="referee_company_name[]"
                                                    class="form-control" id="inputEmailAddress"
                                                    placeholder="Company Name" required value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee Job
                                                    Title</label>
                                                <input type="text" name="referee_job_title[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Job Title" required
                                                    value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee
                                                    Email</label>
                                                <input type="email" name="referee_email[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Email" required
                                                    value="">
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">
                                                        Submit </button>
                                                </div>
                                            </div>
                                        </form>
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
