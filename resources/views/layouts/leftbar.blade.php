<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="{{route('dashboard')}}" class="logo">
                <span>
                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
                </span>
            <span class="">
                    <img src="{{asset('assets/images/logo-light.png')}}" alt="logo-large" class="logo-lg logo-light">
                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
                </span>
        </a>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu" >
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label mt-2">
                        <span>Navigation</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li><!--end nav-item-->
                    <!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarClasses" data-bs-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="sidebarClasses">
                            <i class="iconoir-task-list menu-icon"></i>
                            <span>Course</span>
                        </a>
                        <div class="collapse" id="sidebarClasses">
                            <ul class="nav flex-column">

                                <!-- SSC -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#sscMenu" data-bs-toggle="collapse" role="button"
                                       aria-expanded="false" aria-controls="sscMenu">
                                        SSC
                                    </a>
                                    <div class="collapse" id="sscMenu">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('course.SSC.PDF-Course') }}">PDF Course</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('course.SSC.video.create') }}">Video PDF Course</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('course.SSC.Shortcut')}}">Shortcut Technique</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('course.SSC.Shortcut.video')}}">Video Shortcut Technique</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('course.SSC.All-PDF.create')}}">All PDF</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('course.SSC.All-PDF.create.video')}}">Video All PDF</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('video.create')}}">Video Course</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- HSC -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#hscMenu" data-bs-toggle="collapse" role="button"
                                       aria-expanded="false" aria-controls="hscMenu">
                                        HSC
                                    </a>
                                    <div class="collapse" id="hscMenu">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">PDF Course</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Video Course</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Honours -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#honoursMenu" data-bs-toggle="collapse" role="button"
                                       aria-expanded="false" aria-controls="honoursMenu">
                                        Honours
                                    </a>
                                    <div class="collapse" id="honoursMenu">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('course.honors.create') }}">PDF Course</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('honors.create') }}">MCQ Question</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!--end nav-item-->

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subjects.create') }}">
                            <i class="iconoir-credit-cards menu-icon"></i>
                            <span>Subjects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suggestion.create') }}">
                            <i class="iconoir-credit-cards menu-icon"></i>
                            <span>Suggestion</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('scholarship.create')}}">
                            <i class="iconoir-chat-bubble menu-icon"></i>
                            <span>Scholarship</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('result.create') }}">
                            <i class="iconoir-community menu-icon"></i>
                            <span>Result</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notice.create') }}">
                            <i class="iconoir-calendar menu-icon"></i>
                            <span>Notice</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('device_id')}}">
                            <i class="iconoir-calendar menu-icon"></i>
                            <span>Devices</span>
                        </a>
                    </li>
                    <!--end nav-item-->
                </ul><!--end navbar-nav--->
{{--                <div SSC="update-msg text-center">--}}
{{--                    <div SSC="d-flex justify-content-center align-items-center thumb-lg update-icon-box  rounded-circle mx-auto">--}}
{{--                        <i SSC="iconoir-peace-hand h3 align-self-center mb-0 text-primary"></i>--}}
{{--                    </div>--}}
{{--                    <h5 SSC="mt-3">Mannat Themes</h5>--}}
{{--                    <p SSC="mb-3 text-muted">Approx is a high quality web applications.</p>--}}
{{--                    <a href="javascript: void(0);" SSC="btn text-primary shadow-sm rounded-pill">Upgrade your plan</a>--}}
{{--                </div>--}}
            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
<div class="startbar-overlay d-print-none"></div>
