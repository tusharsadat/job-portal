@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Create Jobs</h5>

                    <form class="p-4 p-md-5" action="{{ route('store.job') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!--job details-->

                        <div class="form-group">
                            <label for="job-title">Job Title</label>
                            <input type="text" name="job_title" class="form-control" id="job_title"
                                placeholder="Enter job title">
                        </div>


                        <div class="form-group">
                            <label for="region">Region</label>
                            <input type="text" name="region" class="form-control" id="region"
                                placeholder="Enter job location">
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company</label>
                            <input type="text" name="company_name" class="form-control" id="company_name"
                                placeholder="company">
                        </div>

                        <div class="form-group">
                            <label for="job-type">Job Type</label>
                            <select name="job_type" class="selectpicker border rounded form-control" id="job-type"
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type">
                                <option value="Part Time">Part Time</option>
                                <option value="Full Time">Full Time</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_vacancy">Vacancy</label>
                            <input name="vacancy" type="text" class="form-control" id="job-vacancy"
                                placeholder="Enter total vacancy">
                        </div>
                        <div class="form-group">
                            <label for="job-experience">Experience</label>
                            <input name="experience" type="text" class="form-control" id="job-experience"
                                placeholder="Enter experience">
                        </div>
                        <div class="form-group">
                            <label for="job-salary">Salary</label>
                            <input name="salary" type="text" class="form-control" id="job-salary"
                                placeholder="Enter salary">
                        </div>

                        <div class="form-group">
                            <label for="job-gender">Gender</label>
                            <select name="gender" class="selectpicker border rounded form-control " id=""
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Any">Any</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="application_deadline">Application Deadline</label>
                            <input name="application_deadline" type="date" class="form-control" id=""
                                placeholder="">
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Job Description</label>
                                <textarea name="job_des" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Job Description..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Responsibilities</label>
                                <textarea name="responsibilities" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Responsibilities..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Education & Experience</label>
                                <textarea name="education_experience" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Education & Experience..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Other Benifits</label>
                                <textarea name="other_benifits" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Other Benifits..."></textarea>
                            </div>
                        </div>

                        <!--company details-->


                        <div class="form-group">
                            <label for="job-type">Categroy</label>
                            <select name="category_id" class="selectpicker border rounded form-control " id=""
                                data-style="btn-black" data-width="100%" data-live-search="true"
                                title="Select Categroy">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job-image">Images</label>
                            <input name="image" type="file" class="form-control">
                        </div>

                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="btn btn-block btn-primary btn-md"
                                        style="margin-left: 180px;" value="Create Job">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
