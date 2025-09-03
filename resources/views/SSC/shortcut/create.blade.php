@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Add Course</h2>

        <form action="{{route('course.SSC.shortcut.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="types" value="technique">
            <input type="hidden" name="class_name" value="SSC">
            <!-- Dropdown: Class -->
            <div class="mb-3">
                <label for="class" class="form-label">Select Group</label>
                <select class="form-select" id="class" name="group" required>
                    <option value="" selected disabled>-- Select Group --</option>
                    <option value="grammar">Grammar</option>
                    <option value="written">Written</option>
                </select>
            </div>

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter course title" required>
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
            </div>

            <!-- Video Link -->
            <div class="mb-3">
                <label for="video_link" class="form-label">Video Link</label>
                <input type="url" class="form-control" id="video_link" name="url" placeholder="Enter video URL" required>
            </div>

            <!-- PDF -->
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('course.SSC.Shortcut.index')}}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
