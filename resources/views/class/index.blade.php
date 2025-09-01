@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Courses Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Types</th>
                <th>Groups</th>
                <th>Title</th>
                <th>Thumbnail</th>
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
                <td>{{ $course->title }}</td>
                <td><img src="{{ asset($course->thumbnail) }}" width="80" alt="{{ $course->title }}"></td>
                <td><a href="{{ $course->url }}" target="_blank">Watch Video</a></td>
                <td><a href="{{ asset($course->pdf) }}" target="_blank">Download PDF</a></td>
                <td>
                    <a href="{{ route('class.SSC.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('class.SSC.delete', $course->id) }}" method="POST" style="display:inline;">
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
