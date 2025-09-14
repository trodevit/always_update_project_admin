@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Add Course</h2>

        <form action="{{route('course.SSC.All-PDF.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="types" value="all_pdf">
            <input type="hidden" name="class_name" value="SSC">
            <!-- Dropdown: Class -->
            <div class="mb-3">
                <label for="class" class="form-label">Select Group</label>
                <select class="form-select" id="class" name="group" required>
                    <option value="" selected disabled>-- Select Group --</option>
                    <option value="science">Science</option>
                    <option value="commerce">Commerce</option>
                    <option value="arts">Arts</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Select Question Types</label>
                <select class="form-select" id="class" name="question_types" required>
                    <option value="" selected disabled>-- Select Question Types --</option>
                    <option value="mcq">MCQ</option>
                    <option value="short_question">Short Question</option>
                    <option value="big_question">Big Question</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Select Subjects</label>
                @if($subjects->count() > 0)
                    <div class="d-flex gap-2">
                        <select class="form-select" id="class" name="subjects" required>
                            <option value="" selected disabled>-- Select Subjects --</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject}}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('subjects.create') }}" class="btn btn-sm btn-success">
                            Add More Subjects
                        </a>
                    </div>
                @else
                    <p class="text-danger">
                        You currently have no subjects. Please add subjects first from the <a href="{{ route('subjects.create') }}">Subjects</a> page.
                    </p>
                @endif
            </div>


            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
            </div>

{{--            <!-- Video Link -->--}}
{{--            <div class="mb-3">--}}
{{--                <label for="video_link" class="form-label">Video Link</label>--}}
{{--                <input type="url" class="form-control" id="video_link" name="url" placeholder="Enter video URL" required>--}}
{{--            </div>--}}

            <!-- PDF -->
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('course.SSC.All-PDF')}}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
