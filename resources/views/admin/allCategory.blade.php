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
                    <h5 class="card-title mb-4 d-inline">All Categories</h5>
                    <a href="{{ route('create.category') }}" class="btn btn-primary mb-4 text-center float-right">Create
                        Categories</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCategory as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td><a href="{{ route('edit.category', $category->id) }}"
                                            class="btn btn-warning text-white text-center ">Update </a></td>
                                    <td><a href="{{ route('delete.category', $category->id) }}"
                                            class="btn btn-danger  text-center ">Delete </a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Display pagination links -->
            {{ $allCategory->links() }}
        </div>
    </div>
@endsection
