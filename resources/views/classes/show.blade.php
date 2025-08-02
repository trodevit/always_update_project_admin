@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <!-- Class Name at Top -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Class: {{ $class->class_name }}</h2>

            <!-- Action Buttons -->
            <div class="btn-group" role="group" aria-label="Class Actions">
                <a href="{{ route('class.edit', $class->id) }}" class="btn btn-primary">Edit Class</a>
                <a href="#" class="btn btn-outline-purple">See Suggestions</a>
                <a href="#" class="btn btn-outline-danger">See Notice</a>
                <a href="#" class="btn btn-outline-info">See Scholarship</a>
                <a href="#" class="btn btn-outline-warning">See Result</a>
                <a href="{{route('class.create')}}" class="btn btn-outline-blue">Back</a>
            </div>
        </div>

        <!-- Optionally, add more info here -->

    </div>
@endsection
