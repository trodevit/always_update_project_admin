@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit Course</h2>

        <form action="{{route('course.SSC.update',$pdf->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- For update -->

            <input type="hidden" name="types" value="{{ $pdf->types }}">
            <input type="hidden" name="class_name" value="{{ $pdf->class_name }}">

            <!-- Dropdown: Group -->
            <div class="mb-3">
                <label for="group" class="form-label">Select Group</label>
                <select class="form-select" id="group" name="group" required>
                    <option value="" disabled>-- Select Group --</option>
                    <option value="science" {{ $pdf->group == 'science' ? 'selected' : '' }}>Science</option>
                    <option value="commerce" {{ $pdf->group == 'commerce' ? 'selected' : '' }}>Commerce</option>
                    <option value="arts" {{ $pdf->group == 'arts' ? 'selected' : '' }}>Arts</option>
                </select>
            </div>

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $pdf->title }}" placeholder="Enter course title" required>
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                @if($pdf->thumbnail)
                    <img src="{{ asset($pdf->thumbnail) }}" alt="Thumbnail" width="100" class="mt-2">
                @endif
            </div>

            <!-- Video Link -->
            <div class="mb-3">
                <label for="video_link" class="form-label">Video Link</label>
                <input type="url" class="form-control" id="video_link" name="url" value="{{ $pdf->url }}" placeholder="Enter video URL" required>
            </div>

            <!-- PDF -->
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
                @if($pdf->pdf)
                    <a href="{{ asset($pdf->pdf) }}" target="_blank" class="d-block mt-2">View Existing PDF</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('course.honors') }}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
