@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">All Jobs</h5>
                    <a href="{{ route('create.job') }}" class="btn btn-primary mb-4 text-center float-right">Create Jobs</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Company</th>
                                <th scope="col">location</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allJobs as $allJob)
                                <tr>
                                    <th scope="row">{{ $allJob->id }}</th>
                                    <td>{{ $allJob->job_title }}</td>
                                    <!-- Display the category name using the relationship -->
                                    <td>{{ $allJob->category->name }}</td>
                                    <td>{{ $allJob->company_name }}</td>
                                    <td>{{ $allJob->region }}</td>
                                    <td>{{ $allJob->created_at->format('Y-m-d') }}</td>
                                    <td><a href="" class="btn btn-warning text-white text-center ">Update </a></td>
                                    <td><a href="#" class="btn btn-danger  text-center ">delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Display pagination links -->
            {{ $allJobs->links() }}
        </div>
    </div>
@endsection
