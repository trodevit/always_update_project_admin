@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <!-- Class Name at Top -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Class: {{ $class->class_name }}</h2>

            <!-- Action Buttons -->
            <div class="btn-group" role="group" aria-label="Class Actions">
                <a href="{{ route('class.edit', $class->id) }}" class="btn btn-primary">Edit Class</a>
                <a href="{{route('class.show',['id'=>$class->id,'show'=>'suggestion'])}}" class="btn btn-outline-purple">See Suggestions</a>
                <a href="{{route('class.show',['id'=>$class->id,'show'=>'notice'])}}" class="btn btn-outline-danger">See Notice</a>
                <a href="{{route('class.show',['id'=>$class->id,'show'=>'scholarship'])}}" class="btn btn-outline-info">See Scholarship</a>
                <a href="{{route('class.show',['id'=>$class->id,'show'=>'result'])}}" class="btn btn-outline-warning">See Result</a>
                <a href="{{route('class.create')}}" class="btn btn-outline-blue">Back</a>
            </div>

        </div>
        @if(isset($classes) && count($classes) > 0)
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Class Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Show PDF</th>
                        <th>Official URL</th>
                        <th>Created At</th>
                        <th>Show Info</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($classes as $index => $class)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $class->class_name }}
                            <td>{{ $class->title }}</td>
                            <td>{{ $class->description }}</td>
                            <td>
                                <a href="{{ asset($class->image) }}" target="_blank">
                                    <img src="{{ asset($class->image) }}" width="50" height="50">
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset($class->pdf) }}" target="_blank">
                                    {{basename($class->pdf)}}
                                </a>
                            </td>
                            <td>
                                @if($class->check == 'notice')
                                    <a href="{{$class->offical_url}}" target="_blank">
                                        {{$class->offical_url}}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $class->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{route('common.show',['id'=>$class->id,'type'=>$class->check])}}" class="btn btn-info">Show Info</a>
                            </td>
                            <td>
                                <a href="{{route('common.edit',['id'=>$class->id,'type'=>$class->check])}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="{{route('common.delete',['id'=>$class->id,'type'=>$class->check])}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No data available.</p>
        @endif
        <!-- Optionally, add more info here -->

    </div>
@endsection
