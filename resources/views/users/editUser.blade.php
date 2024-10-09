@extends('layouts.app')

@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url({{ asset('assets/images/hero_1.jpg') }});" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Edit User</h1>
                    <div class="custom-breadcrumbs">
                        <a href="#">Home</a> <span class="mx-2 slash">/</span>
                        <a href="#">User</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Edit User</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">

            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2>Update User Info</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <form class="p-4 p-md-5 border rounded" action="{{ route('update.user') }}" method="post">
                        @csrf
                        <!--job details-->

                        <div class="form-group">
                            <label for="job-title">Name</label>
                            <input type="text" name="name" value="{{ $editUser->name }}" class="form-control"
                                id="name" placeholder="Enter Name">
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="job-title">Job Title</label>
                            <input type="text" name="job_title" value="{{ $editUser->job_title }}" class="form-control"
                                id="job-title" placeholder="Enter job title">
                        </div>
                        @error('job-title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">User bio</label>
                                <textarea name="user_bio" value="{{ $editUser->user_bio }}" id="" cols="30" rows="7"
                                    class="form-control" placeholder="Write user biodata..."></textarea>
                            </div>
                        </div>
                        @error('user_bio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" value="{{ $editUser->facebook }}" class="form-control"
                                id="facebook" placeholder="Facebook">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" name="twitter" value="{{ $editUser->twitter }}" class="form-control"
                                id="twitter" placeholder="Twitter">
                        </div>
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" name="linkedin" value="{{ $editUser->linkedin }}" class="form-control"
                                id="linkedin" placeholder="Linkedin">
                        </div>
                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <button name="submit" type="submit" class="btn btn-block btn-primary btn-md"
                                        style="margin-left: 182px;">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
