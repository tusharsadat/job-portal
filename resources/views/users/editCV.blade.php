@extends('layouts.app')

@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url({{ asset('assets/images/hero_1.jpg') }});" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Edit CV</h1>
                    <div class="custom-breadcrumbs">
                        <a href="#">Home</a> <span class="mx-2 slash">/</span>
                        <a href="#">User</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Edit CV</strong></span>
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
                            <h2>Update your CV</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <form class="p-4 p-md-5 border rounded" action="{{ route('update.CV') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <!--job details-->

                        <div class="form-group">
                            <label for="cv">Name</label>
                            <input type="file" name="cv" class="form-control">
                        </div>
                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <button name="submit" type="submit" class="btn btn-block btn-primary btn-md"
                                        style="margin-left: 182px;">Upload cv</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
