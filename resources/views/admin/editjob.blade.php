@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                    <form method="POST" action="{{ route('update.job', $job->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" value="{{ $job->id }}" name="job_id"> --}}

                        <!--job details-->
                        <div class="form-group">
                            <label for="job-title">Job Title</label>
                            <input type="text" name="job_title" value="{{ $job->job_title }}" class="form-control"
                                id="job_title" placeholder="Enter job title">
                            <div>
                                @error('job_title')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <input type="text" name="region" value="{{ $job->region }}" class="form-control"
                                id="region" placeholder="Enter job location">
                            <div>
                                @error('region')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company</label>
                            <input type="text" name="company_name" value="{{ $job->company_name }}" class="form-control"
                                id="company_name" placeholder="company">
                            <div>
                                @error('company_name')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job-type">Job Type</label>
                            <select name="job_type" class="selectpicker border rounded form-control" id="job-type"
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type">
                                <option value="Part Time"
                                    {{ old('job_type', $job->job_type) == 'Part Time' ? 'selected' : '' }}>Part Time
                                </option>
                                <option value="Full Time"
                                    {{ old('job_type', $job->job_type) == 'Full Time' ? 'selected' : '' }}>Full Time
                                </option>
                            </select>
                            <div>
                                @error('job_type')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_vacancy">Vacancy</label>
                            <input name="vacancy" value="{{ $job->vacancy }}" type="text" class="form-control"
                                id="job-vacancy" placeholder="Enter total vacancy">
                            <div>
                                @error('vacancy')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job-experience">Experience</label>
                            <input name="experience" value="{{ $job->experience }}" type="text" class="form-control"
                                id="job-experience" placeholder="Enter experience">
                            <div>
                                @error('experience')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job-salary">Salary</label>
                            <input name="salary" value="{{ $job->salary }}" type="text" class="form-control"
                                id="job-salary" placeholder="Enter salary">
                            <div>
                                @error('salary')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job-gender">Gender</label>
                            <select name="gender" class="selectpicker border rounded form-control " id=""
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                                <option value="Male" {{ old('gender', $job->gender) == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ old('gender', $job->gender) == 'Female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="Any" {{ old('gender', $job->gender) == 'Any' ? 'selected' : '' }}>Any
                                </option>
                            </select>
                            <div>
                                @error('gender')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="application_deadline">Application Deadline</label>
                            <input name="application_deadline" value="{{ $job->application_deadline }}" type="date"
                                class="form-control" id="" placeholder="">
                            <div>
                                @error('application_deadline')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Job Description</label>
                                <textarea name="job_des" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Job Description...">{{ old('job_des', $job->job_des) }}</textarea>
                            </div>
                            <div>
                                @error('job_des')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Responsibilities</label>
                                <textarea name="responsibilities" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Responsibilities...">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                            </div>
                            <div>
                                @error('responsibilities')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Education & Experience</label>
                                <textarea name="education_experience" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Education & Experience...">{{ old('education_experience', $job->education_experience) }}</textarea>
                            </div>
                            <div>
                                @error('education_experience')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Other Benifits</label>
                                <textarea name="other_benifits" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Other Benifits...">{{ old('other_benifits', $job->other_benifits) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job-type">Categroy</label>
                            <select name="category_id" class="selectpicker border rounded form-control " id=""
                                data-style="btn-black" data-width="100%" data-live-search="true"
                                title="Select Categroy">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div>
                                @error('category_id')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Current Image</label><br>
                            @if ($job->image)
                                <img src="{{ asset('storage/' . $job->image) }}" alt="Job Image"
                                    style="width: 150px; height: auto;">
                            @else
                                <p>No image available.</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Upload New Image</label>
                            <input type="file" name="image" id="image" class="form-control">

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="btn btn-block btn-primary btn-md"
                                        style="margin-left: 180px;" value="Update Job">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
