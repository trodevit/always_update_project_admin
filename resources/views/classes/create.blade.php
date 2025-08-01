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
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Class Name</h4>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="row">
                        <form action="{{route('class.store')}}" method="post">
                            @csrf
                        <div class="col-lg-6">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label text-end">Class Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="class_name" placeholder="(e.g., SSC, HSC, BSc)" id="example-text-input">
                                </div>
                            </div>

                        </div><!--end col-->

                        <div class="col-lg-6">
                            <div class="mb-3 row">
                                <div class="col-sm-10">
                                    <input class="btn btn-primary" type="submit" value="Submit" id="example-search-input">
                                    <input class="btn btn-danger" type="button" value="Cancel" id="example-search-input">
                                    <a class="btn btn-secondary" href="{{route('class.index', ['show' => 'true'])}}" id="example-search-input">
                                        Show All Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        </form><!--end col-->
                    </div>


                    @if(isset($classes) && count($classes) > 0)
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Show Class Information</th>
                                    <th>Created At</th>
                                    <th>Delete Class</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $index => $class)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $class->class_name }}</td>
                                        <td>
                                            <a href="{{route('class.show',['id'=>$class->id])}}" class="btn btn-blue">Show Class Info</a>
                                        </td>
                                        <td>{{ $class->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{route('class.delete',['id'=>$class->id])}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No data available.</p>
                    @endif


                    <!--end row-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>

@endsection
