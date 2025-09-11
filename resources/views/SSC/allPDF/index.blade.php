@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Courses Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Types</th>
                <th>Groups</th>
                <th>Subjects</th>
                <th>Title</th>
                <th>Video Link</th>
                <th>PDF</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->


            <!-- Add more rows dynamically from database -->

            @foreach($pdf as $course)
            <tr>
                <td>{{ $course->types }}</td>
                <td>{{ $course->group }}</td>
                <td>{{ $course->subject }}</td>
                <td>{{ $course->title }}</td>
                <td>
                    <a href="{{asset($course->thumbnail)}}" target="_blank">
                        <img src="{{ asset($course->thumbnail) }}" width="80" alt="{{ $course->title }}">
                    </a>
                </td>
                <td><a href="{{ asset($course->pdf) }}" target="_blank">Download PDF</a></td>
                <td>
                    <a href="{{ route('course.SSC.All-PDF.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('course.SSC.All-PDF.delete', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
