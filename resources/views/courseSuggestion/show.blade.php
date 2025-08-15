@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Suggestion Details</h2>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $course->title }}</h4>

                <p><strong>Class:</strong> {{ $course->class_name ?? 'N/A' }}</p>

                @if($course->short_description)
                    <p><strong>Description:</strong><br> {{$course->short_description}}</p>
                @endif
                @if ($course->pdf)
                    <div class="mb-3">
                        <strong>PDF:</strong><br>
                        <a href="{{ asset($course->pdf) }}" target="_blank" class="btn btn-outline-primary">
                            View PDF
                        </a>
                    </div>
                @endif
                @if ($course->video_link)
                    <div class="mb-3">
                        <strong>Video Link:</strong><br>
                        <a href="{{ $course->video_link }}" target="_blank" class="btn btn-outline-primary">
                            View Link
                        </a>
                    </div>
                @endif

                <p class="text-muted mt-3">Created at: {{ $course->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <a href="{{ route('course.edit',['type'=>$course->check,'id'=>$course->id]) }}" class="btn btn-primary mt-4">Edit</a>
        @if($course->check == 'suggestion')
            <a href="{{ route('course.suggestion.index') }}" class="btn btn-secondary mt-4">Back to {{$course->check}}</a>
        @elseif($course->check == 'formula')
            <a href="{{ route('course.formula.index') }}" class="btn btn-secondary mt-4">Back to {{$course->check}}</a>
        @elseif($course->check == 'video')
            <a href="{{ route('course.video.index') }}" class="btn btn-secondary mt-4">Back to {{$course->check}}</a>
        @endif
    </div>
@endsection
