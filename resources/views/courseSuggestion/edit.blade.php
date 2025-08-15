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
                            <form action="{{route('updateData',['type'=>$course->check,'id'=>$course->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            @if($course->check == 'suggestion')
                                                <input class="form-control" type="hidden" name="check" value="suggestion" id="example-text-input">
                                            @elseif($course->check == 'formula')
                                                <input class="form-control" type="hidden" name="check" value="formula" id="example-text-input">
                                            @elseif($course->check == 'video')
                                                <input class="form-control" type="hidden" name="check" value="video" id="example-text-input">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="class_name" class="col-sm-2 col-form-label text-end">Class Name</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="class_name" id="class_name" required>
                                                <option value="{{$course->class_name}}" selected>{{$course->class_name}}</option>
                                                <option value="SSC">SSC</option>
                                                <option value="HSC">HSC</option>
                                                <option value="Honors">Honors</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label text-end">Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="title" value="{{old('title',$course->title)}}" id="example-text-input">
                                        </div>
                                    </div>
                                    @if($course->pdf)
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label text-end">PDF</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" name="pdf" placeholder="(e.g., SSC, HSC, BSc)" id="example-text-input" accept="application/pdf">
                                            </div>
                                        </div>
                                    @endif
                                    @if($course->short_description)
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label text-end">Short Description</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="short_description" value="{{old('short_description',$course->short_description)}}" id="example-text-input">
                                            </div>
                                        </div>
                                    @endif
                                    @if($course->video_link)
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label text-end">Video Link</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="video_link" value="{{old('video_link',$course->video_link)}}" id="example-text-input">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            <input class="btn btn-primary" type="submit" value="Submit" id="example-search-input">
                                            <input class="btn btn-danger" type="button" value="Cancel" id="example-search-input">
                                            @if($course->check == 'suggestion')
                                                <a class="btn btn-info" href="{{route('course.suggestion.index')}}" id="example-search-input">
                                                    Show All Data
                                                </a>
                                            @elseif($course->check == 'formula')
                                                <a class="btn btn-info" href="{{route('course.formula.index')}}" id="example-search-input">
                                                    Show All Data
                                                </a>
                                            @elseif($course->check == 'video')
                                                <a class="btn btn-info" href="{{route('course.video.index')}}" id="example-search-input">
                                                    Show All Data
                                                </a>
                                            @endif
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
