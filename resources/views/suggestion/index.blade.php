@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Elements</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Approx</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item"><a href="#">Forms</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item active">Elements</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>PDF</th>
                    <th>Created At</th>
                    <th>Show Suggestion</th>
                    <th>Delete Class</th>
                </tr>
                </thead>
                <tbody>
                @foreach($common as $index => $class)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $class->class_name }}</td>
                        <td>{{ $class->title }}</td>
                        <td>{{ $class->description }}</td>
                        <td>
                            <a href="{{asset($class->image)}}" target="_blank">
                                <img src="{{asset($class->image)}}" width="50" height="50">
                            </a>
                        </td>
                        <td>
                            <a href="{{asset($class->pdf)}}" target="_blank">Show PDF</a>
                        </td>
                        <td>{{ $class->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{route('common.show',['type'=>$class->check,'id'=>$class->id])}}" class="btn btn-primary">Show Suggestion</a>
                        </td>
                        <td>
                            <a href="{{route('common.delete',['type'=>$class->check,'id'=>$class->id])}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
