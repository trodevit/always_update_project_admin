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
                            <form action="{{route('suggestion.update',['id'=>$common->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="hidden" name="check" value="suggestion" id="example-text-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="class_name" class="col-sm-2 col-form-label text-end">Class Name</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="class_id" id="class_name" required>
                                                <option value="{{$common->class_id}}" selected>{{$common->class_name}}</option>
                                                @foreach($class as $classes)
                                                    <option value="{{$classes->id}}">{{$classes->id}}. {{$classes->class_name}}</option>
                                                @endforeach
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label text-end">Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="title" value="{{$common->title}}" id="example-text-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label text-end">Image Upload</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="image" placeholder="(e.g., SSC, HSC, BSc)" id="example-text-input" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label text-end">PDF</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="pdf" placeholder="(e.g., SSC, HSC, BSc)" id="example-text-input" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label text-end">Short Description</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="description" value="{{$common->description}}" id="example-text-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            <input class="btn btn-primary" type="submit" value="Submit" id="example-search-input">
                                            <input class="btn btn-danger" type="button" value="Cancel" id="example-search-input">
                                            <a class="btn btn-info" href="{{route('suggestion.index')}}" id="example-search-input">
                                                Show All Data
                                            </a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </form><!--end col-->
                        </div>
                        <!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div>

@endsection
