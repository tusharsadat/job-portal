@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                    <form method="POST" action="{{ route('update.category') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $categoryinfo->id }}" name="category_id">
                        <!-- Name input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" value="{{ $categoryinfo->name }}" id="form2Example1"
                                class="form-control" placeholder="name" />
                            <div>
                                @error('name')
                                    <div class="text-warning">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
