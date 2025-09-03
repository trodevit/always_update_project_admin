@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit Suggestion</h2>

        <form action="{{route('suggestion.update',$upload->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- For update -->

            <input type="hidden" name="types" value="{{ $upload->types }}">
            <input type="hidden" name="class_name" value="{{ $upload->class_name }}">

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $upload->title }}" placeholder="Enter course title" required>
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Image</label>
                <input type="file" class="form-control" id="thumbnail" name="image" accept="image/*">
                @if($upload->image)
                    <img src="{{ asset($upload->image) }}" alt="Thumbnail" width="100" class="mt-2">
                @endif
            </div>

            <!-- Video Link -->
            <div class="mb-3">
                <label for="video_link" class="form-label">Description</label>
                <input type="text" class="form-control" id="video_link" name="description" value="{{ $upload->description }}" placeholder="Enter video URL" required>
            </div>

            <!-- PDF -->
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
                @if($upload->pdf)
                    <a href="{{ asset($upload->pdf) }}" target="_blank" class="d-block mt-2">View Existing PDF</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('suggestion.index') }}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
