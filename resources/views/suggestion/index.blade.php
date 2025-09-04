@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Suggestion Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Class Name</th>
                <th>Title</th>
                <th>Thumbnail</th>
                <th>Description</th>
                <th>PDF</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->


            <!-- Add more rows dynamically from database -->

            @foreach($suggestions as $course)
            <tr>
                <td>{{ strtoupper($course->class_name) }}</td>
                <td>{{ $course->title }}</td>
                <td>
                    <a href="{{asset($course->image)}}" target="_blank">
                        <img src="{{ asset($course->image) }}" width="80" alt="{{ $course->title }}">
                    </a>
                </td>
                <td>{{ $course->description }}</td>
                <td><a href="{{ asset($course->pdf) }}" target="_blank">Download PDF</a></td>
                <td>
                    <a href="{{ route('suggestion.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('suggestion.delete', $course->id) }}" method="POST" style="display:inline;">
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
