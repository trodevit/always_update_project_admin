@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <!-- Class Name Update Form -->
        <div class="mb-4">
            <h4>Update Class Name</h4>
            <form action="{{ route('class.update', $class->id) }}" method="POST" class="d-flex align-items-center gap-3">
                @csrf


                <div class="form-group mb-0">
                    <input type="text" name="class_name" value="{{ old('class_name', $class->class_name) }}" class="form-control" placeholder="Enter class name" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            @if ($errors->has('class_name'))
                <div class="text-danger mt-1">
                    {{ $errors->first('class_name') }}
                </div>
            @endif
        </div>
    </div>
@endsection
