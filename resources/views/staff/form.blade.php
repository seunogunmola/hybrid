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
                                            <h5>Personal Details</h5>
                                            <div class="col-sm-6">
                                                <label for="inputFirstName" class="form-label">First Name</label>
                                                <input type="text" name="firstname" class="form-control"
                                                    id="inputFirstName" placeholder="Your First Name" required
                                                    value="{{ old('firstname', $user->firstname) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Last Name</label>
                                                <input type="text" name="lastname" class="form-control"
                                                    id="inputLastName" placeholder="Your Last Name" required
                                                    value="{{ old('lastname', $user->lastname) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" name="email" class="form-control"
                                                    id="inputEmailAddress" placeholder="Your Email Address" required
                                                    value="{{ old('email', $user->email) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Phone Number</label>
                                                <input type="tel" name="phone" class="form-control"
                                                    id="inputEmailAddress" placeholder="Your Phone Number" required
                                                    value="{{ old('phone', $user->phone) }}">
                                            </div>
                                            <h6>Address</h6>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label"> Number/Street</label>
                                                <input type="text" name="address" class="form-control"
                                                    id="inputEmailAddress" placeholder="Number/Street" required
                                                    value="{{ old('address', $user->address) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label"> Post Town</label>
                                                <input type="text" name="post_town" class="form-control"
                                                    id="inputEmailAddress" placeholder="Post Town" required
                                                    value="{{ old('post_town', $user->post_town) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label"> Post Code</label>
                                                <input type="text" name="post_code" class="form-control"
                                                    id="inputEmailAddress" placeholder="Post Code" required
                                                    value="{{ old('post_code', $user->post_code) }}">
                                            </div>
                                            <h5>Your CV</h5>
                                            <div class="col-sm-12">
                                                <label for="inputLastName" class="form-label">Upload Your CV</label>
                                                <input type="file" name="cv_file" class="form-control"
                                                    id="inputLastName" placeholder="" {{ $user->cv !== null ? "" : "required" }} >
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
                                                <textarea name="supporting_statement" class="form-control" id="" cols="30" rows="5" required>{{ old('supporting_statement',$user->supporting_statement) }}</textarea>
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
                                                            <label for="job_title" class="form-label">Job
                                                                Title</label>
                                                            <input type="text" name="job_title[]"
                                                                class="form-control" placeholder="Job Title" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="company_name" class="form-label">Company
                                                                Name</label>
                                                            <input type="text" name="company_name[]"
                                                                class="form-control" placeholder="Company Name"
                                                                required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="job_start_date" class="form-label">Employment
                                                                Start Date</label>
                                                            <input type="date" name="job_start_date[]"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="job_end_date" class="form-label">Employment
                                                                End Date</label>
                                                            <input type="date" name="job_end_date[]"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="job_details" class="form-label">Job
                                                                Details</label>
                                                            <textarea name="job_details[]" class="form-control" cols="30" rows="5" placeholder="Job Details"></textarea>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>

                                            <!-- Add New Button -->
                                            <div class="col-6">
                                                <button type="button" id="add-job-btn" class="btn btn-success">Add
                                                    New Job</button>
                                            </div>



                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    document.getElementById('add-job-btn').addEventListener('click', function() {
                                                        alert('Add New Job');
                                                        // Get the job fields container
                                                        var container = document.getElementById('job-fields');

                                                        // Clone the first set of job fields
                                                        var jobEntry = document.querySelector('.job-entry').cloneNode(true);

                                                        // Clear the input values in the cloned node
                                                        var inputs = jobEntry.querySelectorAll('input');
                                                        var textareas = jobEntry.querySelectorAll('textarea');

                                                        inputs.forEach(function(input) {
                                                            input.value = ''; // Clear the value
                                                        });

                                                        textareas.forEach(function(textarea) {
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
                                                    value="{{ old('referee_name.1',isset($user->references[0]->referee_name) ?? null ) }}"
                                                    >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Company Name</label>
                                                <input type="text" name="referee_company_name[]"
                                                    class="form-control" id="inputEmailAddress"
                                                    placeholder="Company Name" required 
                                                    value="{{ old('referee_company_name.1',isset($user->references[0]->referee_company_name) ?? null ) }}"
                                                    >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee Job
                                                    Title</label>
                                                <input type="text" name="referee_job_title[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Job Title" required
                                                    value="{{ old('referee_job_title.1',isset($user->references[0]->referee_job_title) ?? null) }}"
                                                    >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee
                                                    Email</label>
                                                <input type="email" name="referee_email[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Email" required
                                                    value="{{ old('referee_email.1',isset($user->references[0]->referee_email) ?? null ) }}"
                                                    >
                                            </div>
                                            <hr>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee 2
                                                    Name</label>
                                                <input type="text" name="referee_name[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Name" required
                                                    value="{{ old('referee_name.2',isset($user->references[1]->referee_name) ?? null ) }}"
                                                    >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Company Name</label>
                                                <input type="text" name="referee_company_name[]"
                                                    class="form-control" id="inputEmailAddress"
                                                    placeholder="Company Name" required 
                                                    value="{{ old('referee_company_name.2', isset($user->references[1]->referee_company_name)) ?? null }}"
                                                    >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee Job
                                                    Title</label>
                                                <input type="text" name="referee_job_title[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Job Title" required
                                                    value="{{ old('referee_job_title.2', isset($user->references[1]->referee_job_title)) ?? null }}"
                                                    >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmailAddress" class="form-label">Referee
                                                    Email</label>
                                                <input type="email" name="referee_email[]" class="form-control"
                                                    id="inputEmailAddress" placeholder="Referee Email" required
                                                    value="{{ old('referee_email.2',isset($user->references[1]->referee_email)) ?? null }}"
                                                    >
                                            </div>
                                            <h5>Declarations</h5>
                                            <p>
                                                This job is working with children and/or vulnerable adults and is exempt
                                                from the Rehabilitation of Offenders Act 1974. You must tell us about
                                                any cautions and criminal convictions, that are not protected. See Nacro
                                                guidance for more information.
                                                It is an offence to apply for this role, if you are barred from engaging
                                                in
                                                regulated activity relevant to children or vulnerable adults.
                                            </p>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Do you have any
                                                    adult cautions (simple or conditional) or spent
                                                    convictions that are not protected as defined by the Rehabilitation
                                                    of
                                                    Offenders Act 1974 (Exceptions) Order 1975 (Amendment) (England and
                                                    Wales) Order 2020?</label>
                                                <select class="form-select" name="adult_cautions" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->adult_cautions == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->adult_cautions == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Are you barred from
                                                    working with children or vulnerable
                                                    adults?</label>
                                                <select class="form-select" name="barred_from_children" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->barred_from_children == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->barred_from_children == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    subject to a child court protection proceeding or
                                                    order?</label>
                                                <select class="form-select" name="child_court_protection" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->child_court_protection == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->child_court_protection == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    subject to an adult court protection proceeding or
                                                    order?</label>
                                                <select class="form-select" name="adult_court_protection" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->adult_court_protection == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->adult_court_protection == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    refused/cancelled registration relating to
                                                    childcare?</label>
                                                <select class="form-select" name="childcare_cancellation" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->childcare_cancellation == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->childcare_cancellation == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    refused/cancelled registration relating to
                                                    residential homes?</label>
                                                <select class="form-select" name="residential_cancellation" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->residential_cancellation == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->residential_cancellation == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    prohibited from teaching children or from
                                                    childcare?</label>
                                                <select class="form-select" name="teaching_prohibition" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->teaching_prohibition == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->teaching_prohibition == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    prohibited from caring for vulnerable
                                                    adults?</label>
                                                <select class="form-select" name="adult_prohibition" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->adult_prohibition == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->adult_prohibition == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    barred or restricted from working by an
                                                    employer?</label>
                                                <select class="form-select" name="barred_by_employer" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->barred_by_employer == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->barred_by_employer == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Have you ever been
                                                    barred or restricted from working by a
                                                    professional body?</label>
                                                <select class="form-select" name="barred_by_professional_body" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Yes" {{ $user->barred_by_professional_body == "Yes" ? "selected" : ""}}> Yes </option>
                                                    <option value="No" {{ $user->barred_by_professional_body == "No" ? "selected" : ""}}> No </option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">If Yes to any of the
                                                    above, please give details</label>
                                                <textarea name="declaration_details" id="" cols="30" rows="5" class="form-control" required>{{ $user->declaration_details }}</textarea>
                                            </div>
                                            <h5>Summary and Apply</h5>
                                            <p>
                                                I understand and confirm that my personal data on this form is only
                                                used for recruitment purposes and my data is protected by law.
                                                <br>I confirm that the information that I have provided is true and
                                                correct
                                                and will be used as part of my contract of employment. I accept that
                                                providing deliberately false information, could result in my dismissal,
                                                if
                                                appointed to the job
                                            </p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="agree" required>
                                                <label class="form-check-label" for="flexCheckDefault">I agree to the Above Statements</label>
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
