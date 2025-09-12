@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit {{$upload->title}}</h2>

        <form action="{{route('video.update',$upload->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="types" value="{{$upload->types}}">
            <input type="hidden" name="class_name" value="{{$upload->class_name}}">
            <!-- Dropdown: Class -->
            <div class="mb-3">
                <label for="class" class="form-label">Select Group</label>
                <select class="form-select" id="class" name="group" required>
                    <option value="" selected disabled>-- Select Group --</option>
                    <option value="science"{{ $upload->group == 'science' ? 'selected' : '' }}>Science</option>
                    <option value="commerce"{{ $upload->group == 'commerce' ? 'selected' : '' }}>Commerce</option>
                    <option value="arts"{{ $upload->group == 'arts' ? 'selected' : '' }}>Arts</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Select Subjects</label>
                @if($subjects)
                    <select class="form-select" id="class" name="subjects" required>
                        <option value="" selected disabled>-- Select Subjects --</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}" {{ $upload->subjects == $subject->id ? 'selected' : '' }}>{{$subject->subject}}</option>
                        @endforeach
                    </select>
                @else
                    <p class="text-danger">
                        You currently have no subjects. Please add subjects first from the <a href="{{ route('subjects.create') }}">Subjects</a> page.
                    </p>
                @endif
            </div>

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$upload->title}}" placeholder="Enter title">
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                @if($upload->thumbnail)
                    <img src="{{ asset($upload->thumbnail) }}" alt="Thumbnail" width="100" class="mt-2">
                @endif
            </div>

            <!-- Video Link -->
            <div class="mb-3">
                <label for="video_link" class="form-label">Video Link</label>
                <input type="url" class="form-control" id="video_link" name="url" value="{{$upload->url}}" placeholder="Enter video URL" required>
            </div>

            <!-- PDF -->
{{--            <div class="mb-3">--}}
{{--                <label for="pdf" class="form-label">PDF</label>--}}
{{--                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">--}}
{{--                @if($upload->pdf)--}}
{{--                    <a href="{{ asset($upload->pdf) }}" target="_blank" class="d-block mt-2">View Existing PDF</a>--}}
{{--                @endif--}}
{{--            </div>--}}

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('video.index')}}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
