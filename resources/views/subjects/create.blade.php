@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Add Subject</h2>
        <form action="{{route('subjects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Subject Title</label>
                <input type="text" class="form-control" id="title" name="subject" placeholder="Enter subject name" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-5">

        <h2 class="mb-4">Subjects Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Subject</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->


            <!-- Add more rows dynamically from database -->

            @foreach($subjects as $course)
                <tr>
                    <td>
                        <input type="text" name="subject" value="{{ $course->subject }}" class="form-control" form="update-form-{{ $course->id }}">
                    </td>
                    <td>
                        <form id="update-form-{{ $course->id }}" action="{{route('subjects.update',$course->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary">Update</button>
                        </form>
                        <form action="{{ route('subjects.destroy', $course->id) }}" method="POST" style="display:inline;">
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
