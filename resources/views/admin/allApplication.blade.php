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
                    <h5 class="card-title mb-4 d-inline">Job Applications</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CV</th>
                                <th scope="col">Email</th>
                                <th scope="col">View job</th>
                                <th scope="col">Job title</th>
                                <th scope="col">Company</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allApplication as $application)
                                <tr>
                                    <th scope="row">{{ $application->id }}</th>
                                    <td><a class="btn btn-success" href="{{ Storage::url($application->cv) }}">CV</a>
                                    </td>
                                    <td>{{ $application->user_email }}</td>
                                    <td><a class="btn btn-success"
                                            href="{{ route('single-job', $application->job_id) }}">view job</a></td>
                                    <td>{{ $application->job_title }}</td>
                                    <td>{{ $application->company_name }}</td>
                                    <td><a href="#" class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Display pagination links -->
            {{ $allApplication->links() }}
        </div>
    </div>
@endsection
