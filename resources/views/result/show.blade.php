@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Suggestion Details</h2>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $common->title }}</h4>

                <p><strong>Class:</strong> {{ $common->class_name ?? 'N/A' }}</p>

                <p><strong>Description:</strong><br> {{$common->description }}</p>

                @if ($common->image)
                    <div class="mb-3">
                        <strong>Image:</strong><br>
                        <img src="{{ asset($common->image) }}" alt="Suggestion Image" class="img-fluid" style="max-width: 300px;">
                    </div>
                @endif

                @if ($common->pdf)
                    <div class="mb-3">
                        <strong>PDF:</strong><br>
                        <a href="{{ asset($common->pdf) }}" target="_blank" class="btn btn-outline-primary">
                            View PDF
                        </a>
                    </div>
                @endif

                <p class="text-muted mt-3">Created at: {{ $common->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <a href="{{ route('common.edit',['type'=>$common->check,'id'=>$common->id]) }}" class="btn btn-primary mt-4">Edit</a>
        <a href="{{ route('result.index') }}" class="btn btn-secondary mt-4">Back to Result</a>
    </div>
@endsection
