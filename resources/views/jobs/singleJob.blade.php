@extends('layouts.app')

@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url({{ asset('assets/images/hero_1.jpg') }});" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">{{ $singleJob->job_title }}</h1>
                    <div class="custom-breadcrumbs">
                        <a href="#">Home</a> <span class="mx-2 slash">/</span>
                        <a href="#">Job</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>{{ $singleJob->job_title }}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="margin-top: 5px">
        @php
            $alertTypes = ['success', 'error', 'info', 'warning'];
        @endphp

        @foreach ($alertTypes as $alertType)
            @if (session()->has($alertType))
                <div class="alert alert-{{ $alertType }}" id="alert-{{ $alertType }}">
                    {{ session($alertType) }}
                </div>
            @endif
        @endforeach
    </div>


    <section style="padding-bottom:0px;" class="site-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div class="border p-2 d-inline-block mr-3 rounded">
                            <img style="height: 150px; width:150px;" src="{{ $singleJob->image }}" alt="Image">
                        </div>
                        <div>
                            <h2>{{ $singleJob->job_title }}</h2>
                            <div>
                                <span class="ml-0 mr-2 mb-2"><span
                                        class="icon-briefcase mr-2"></span>{{ $singleJob->company_name }}</span>
                                <span class="m-2"><span class="icon-room mr-2"></span>{{ $singleJob->region }}</span>
                                <span class="m-2"><span class="icon-clock-o mr-2"></span><span
                                        class="text-primary">{{ $singleJob->job_type }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-5">
                            <figure class="mb-5"><img src="{{ asset('assets/images/job_single_img_1.jpg') }}"
                                    alt="Image" class="img-fluid rounded"></figure>
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-align-left mr-3"></span>Job Description</h3>
                            <p>{{ $singleJob->job_des }}</p>

                        </div>
                        <div class="mb-5">
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-rocket mr-3"></span>Responsibilities</h3>
                            <p>{{ $singleJob->responsibilities }}</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-book mr-3"></span>Education + Experience</h3>
                            <p>{{ $singleJob->education_experience }}</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-turned_in mr-3"></span>Other Benifits</h3>
                            <p>{{ $singleJob->other_benifits }}</p>
                        </div>

                        <div class="row mb-5">
                            <div class="col-6">
                                @if (isset(Auth::user()->id))
                                    <form action="{{ route('save.job') }}" method="post">
                                        @csrf
                                        <input name="job_id" type="hidden" value="{{ $singleJob->id }}">
                                        <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                        <input name="image" type="hidden" value="{{ $singleJob->image }}">
                                        <input name="job_title" type="hidden" value="{{ $singleJob->job_title }}">
                                        <input name="region" type="hidden" value="{{ $singleJob->region }}">
                                        <input name="company_name" type="hidden" value="{{ $singleJob->company_name }}">
                                        <input name="job_type" type="hidden" value="{{ $singleJob->job_type }}">
                                        @if ($saved_job > 0)
                                            <button class="btn btn-block btn-success btn-md" disabled>Job Already
                                                Save</button>
                                        @else
                                            <button name="submit" type="submit" class="btn btn-block btn-light btn-md"><i
                                                    class="icon-heart"></i>Save Job</button>
                                        @endif

                                    </form>
                                @endif
                                <!--add text-danger to it to make it read-->
                            </div>
                            <div class="col-6">
                                @if (isset(Auth::user()->id))
                                    <form action="{{ route('apply.job') }}" method="post">
                                        @csrf
                                        <input name="cv" type="hidden" value="{{ Auth::user()->cv }}">
                                        <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                        <input name="job_id" type="hidden" value="{{ $singleJob->id }}">
                                        <input name="image" type="hidden" value="{{ $singleJob->image }}">
                                        <input name="job_title" type="hidden" value="{{ $singleJob->job_title }}">
                                        <input name="region" type="hidden" value="{{ $singleJob->region }}">
                                        <input name="company_name" type="hidden"
                                            value="{{ $singleJob->company_name }}">
                                        <input name="job_type" type="hidden" value="{{ $singleJob->job_type }}">
                                        @if ($apply_job > 0)
                                            <button class="btn btn-block btn-success btn-md" disabled>Job Already
                                                applied</button>
                                        @else
                                            <button name="submit" type="submit"
                                                class="btn btn-block btn-primary btn-md">Apply Job</button>
                                        @endif

                                    </form>
                                @else
                                    <a href="{{ route('login') }}"><button class="btn btn-block btn-info btn-md"
                                            disabled>Login
                                            for apply job</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="bg-light p-3 border rounded mb-4">
                            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
                            <ul class="list-unstyled pl-3 mb-0">
                                <li class="mb-2"><strong class="text-black">Published
                                        on: </strong>{{ $singleJob->created_at }}</li>
                                <li class="mb-2"><strong class="text-black">Vacancy: </strong>{{ $singleJob->vacancy }}
                                </li>
                                <li class="mb-2"><strong class="text-black">Employment
                                        Status: </strong>{{ $singleJob->job_type }}</li>
                                <li class="mb-2"><strong class="text-black">Experience:
                                    </strong>{{ $singleJob->experience }}</li>
                                <li class="mb-2"><strong class="text-black">Job
                                        Location: </strong>{{ $singleJob->region }}</li>
                                <li class="mb-2"><strong class="text-black">Salary: </strong>{{ $singleJob->salary }}
                                </li>
                                <li class="mb-2"><strong class="text-black">Gender: </strong>{{ $singleJob->gender }}
                                </li>
                                <li class="mb-2"><strong class="text-black">Application
                                        Deadline: </strong>{{ $singleJob->application_deadline }}</li>
                            </ul>
                        </div>

                        <div class="bg-light p-3 border rounded">
                            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
                            <div class="px-3">
                                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                            </div>
                        </div>

                        <div class="bg-light p-3 mt-4 border rounded">
                            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job category</h3>
                            <div class="px-3">
                                @foreach ($categories as $categorie)
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><a
                                                href="{{ route('single.category', ['id' => $categorie->id, 'name' => $categorie->name]) }}"
                                                class="text-decoration-none">{{ $categorie->name }}</a></li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>

    <section style="padding-top:0px; padding-bottom:0px;" class="site-section" id="next">
        <div class="container">

            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">{{ $relatedJobCount }} Related Jobs</h2>
                </div>
            </div>

            <ul class="job-listings mb-5">
                @foreach ($relatedJobs as $job)
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="{{ route('single-job', $job->id) }}"></a>
                        <div class="job-listing-logo">
                            <img src="{{ $job->image }}" alt="Image" class="img-fluid">
                        </div>

                        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                <h2>{{ $job->job_title }}</h2>
                                <strong>{{ $job->company_name }}</strong>
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                <span class="icon-room"></span> {{ $job->region }}
                            </div>
                            <div class="job-listing-meta">
                                <span class="badge badge-danger">{{ $job->job_type }}</span>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </section>


    <section class="bg-light pt-5 testimony-full">

        <div class="owl-carousel single-carousel">


            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center text-center text-lg-left">
                        <blockquote>
                            <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero
                                dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum
                                repudiandae.&rdquo;</p>
                            <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
                        </blockquote>
                    </div>
                    <div class="col-lg-6 align-self-end text-center text-lg-right">
                        <img src="{{ asset('assets/images/person_transparent_2.png') }}" alt="Image"
                            class="img-fluid mb-0">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center text-center text-lg-left">
                        <blockquote>
                            <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero
                                dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum
                                repudiandae.&rdquo;</p>
                            <p><cite> &mdash; Chris Peters, @Google</cite></p>
                        </blockquote>
                    </div>
                    <div class="col-lg-6 align-self-end text-center text-lg-right">
                        <img src="{{ asset('assets/images/person_transparent.png') }}" alt="Image"
                            class="img-fluid mb-0">
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
                    <h2 class="text-white">Get The Mobile Apps</h2>
                    <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora
                        adipisci impedit.</p>
                    <p class="mb-0">
                        <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span
                                class="icon-apple mr-3"></span>App Store</a>
                        <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span
                                class="icon-android mr-3"></span>Play Store</a>
                    </p>
                </div>
                <div class="col-md-6 ml-auto align-self-end">
                    <img src="{{ asset('assets/images/apps.png') }}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <script>
        // Auto-hide all alert messages after 5 seconds
        setTimeout(function() {
            @foreach ($alertTypes as $alertType)
                var alert = document.getElementById('alert-{{ $alertType }}');
                if (alert) {
                    alert.style.display = 'none';
                }
            @endforeach
        }, 5000); // Hide after 5 seconds
    </script>
@endsection
