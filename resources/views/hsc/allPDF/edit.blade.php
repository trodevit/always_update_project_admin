@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit {{$upload->title}}</h2>

        <form action="{{route('hsc.allpdf.update',$upload->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="types" value="{{$upload->types}}">
            <input type="hidden" name="class_name" value="{{$upload->class_name}}">
            <!-- Dropdown: Class -->
            <div class="mb-3">
                <label for="class" class="form-label">Select Class</label>
                <select class="form-select" id="class" name="hsc_year" required>
                    <option value="" selected disabled>-- Select Question Types --</option>
                    @foreach($hsc as $hssc)
                        <option value="{{$hssc->id}}" {{ $upload->hsc_year == $hssc->id ? 'selected' : '' }}>{{$hssc->class_name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Select Question Types</label>
                <select class="form-select" id="class" name="question_types" required>
                    <option value="" selected disabled>-- Select Question Types --</option>
                    <option value="mcq" {{ $upload->question_types == 'mcq' ? 'selected' : '' }}>MCQ</option>
                    <option value="short_question" {{ $upload->question_types == 'short_question' ? 'selected' : '' }}>Short Question</option>
                    <option value="big_question" {{ $upload->question_types == 'big_question' ? 'selected' : '' }}>Big Question</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="group" class="form-label">Select Group</label>
                <select class="form-select" id="group" name="group" required>
                    <option value="" disabled>-- Select Group --</option>
                    <option value="science" {{ $upload->group == 'science' ? 'selected' : '' }}>Science</option>
                    <option value="commerce" {{ $upload->group == 'commerce' ? 'selected' : '' }}>Commerce</option>
                    <option value="arts" {{ $upload->group == 'arts' ? 'selected' : '' }}>Arts</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="subjects" class="form-label">Select Subjects</label>
                @if($subjects->count() > 0)
                    <div class="d-flex gap-2">
                        <select class="form-select" id="subjects" name="subjects" required>
                            <option value="" disabled>-- Select Subjects --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                        data-group="{{ $subject->group }}"
                                    {{ $upload->subjects == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject }}
                                </option>
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

            <script>
                function filterSubjects() {
                    let selectedGroup = document.getElementById('group').value;
                    let subjectSelect = document.getElementById('subjects');
                    let selectedSubject = "{{ $upload->subjects }}"; // keep the previous subject id

                    for (let option of subjectSelect.options) {
                        if (option.value === "") continue;
                        if (option.getAttribute('data-group') === selectedGroup) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                            // remove selection if not in selected group
                            if (option.value == selectedSubject) {
                                subjectSelect.value = "";
                            }
                        }
                    }
                }

                // Run filter on page load & when group changes
                document.getElementById('group').addEventListener('change', filterSubjects);
                window.addEventListener('load', filterSubjects);
            </script>


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

            {{--            <!-- Video Link -->--}}
            {{--            <div class="mb-3">--}}
            {{--                <label for="video_link" class="form-label">Video Link</label>--}}
            {{--                <input type="url" class="form-control" id="video_link" name="url" placeholder="Enter video URL" required>--}}
            {{--            </div>--}}

            <!-- PDF -->
            <div class="mb-3">
                <label for="pdf" class="form-label">PDF</label>
                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
                @if($upload->pdf)
                    <a href="{{ asset($upload->pdf) }}" target="_blank" class="d-block mt-2">View Existing PDF</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('course.SSC')}}" class="btn btn-info">All List</a>
        </form>
    </div>
@endsection
