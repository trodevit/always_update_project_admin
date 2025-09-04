@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Add Notice</h2>

        <form action="{{route('notice.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="types" value="notice">
            <div class="mb-3">
                <label for="class" class="form-label">Select Class</label>
                <select class="form-select" id="class" name="class_name" required>
                    <option value="" selected disabled>-- Select Class --</option>
                    <option value="ssc">SSC</option>
                    <option value="hsc">HSC</option>
                    <option value="college_admission">College Admission</option>
                    <option value="honors">Honors</option>
                </select>
            </div>
            <!-- Dropdown: Class -->


            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter course title" required>
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Image</label>
                <input type="file" class="form-control" id="thumbnail" name="image" accept="image/*" required>
            </div>

            <!-- Video Link -->
            <div class="mb-3">
                <label for="video_link" class="form-label">Description</label>
                <input type="text" class="form-control" id="video_link" name="description" placeholder="Enter video URL" required>
            </div>

            <div class="mb-3">
                <label for="video_link" class="form-label">Official URL</label>
                <input type="text" class="form-control" id="video_link" name="official_url" placeholder="Enter video URL" required>
            </div>

            <!-- PDF -->
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('notice.index')}}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
