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
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('class.create')}}">
                            <i class="iconoir-hand-cash menu-icon"></i>
                            <span>Add Classes</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarTransactions" data-bs-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="sidebarTransactions">
                            <i class="iconoir-task-list menu-icon"></i>
                            <span>Courses</span>
                        </a>
                        <div class="collapse " id="sidebarTransactions">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('course.suggestion.create')}}">Course Suggestion</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('course.formula.create')}}">Course Formula</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('course.video.create')}}">Course Video</a>
                                </li>
                            </ul><!--end nav-->
                        </div><!--end startbarTables-->
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('suggestion.create')}}">
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
                        <a class="nav-link" href="{{route('result.create')}}">
                            <i class="iconoir-community menu-icon"></i>
                            <span>Result</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('notice.create')}}">
                            <i class="iconoir-calendar menu-icon"></i>
                            <span>Notice</span>
                        </a>
                    </li><!--end nav-item-->
                </ul><!--end navbar-nav--->
{{--                <div class="update-msg text-center">--}}
{{--                    <div class="d-flex justify-content-center align-items-center thumb-lg update-icon-box  rounded-circle mx-auto">--}}
{{--                        <i class="iconoir-peace-hand h3 align-self-center mb-0 text-primary"></i>--}}
{{--                    </div>--}}
{{--                    <h5 class="mt-3">Mannat Themes</h5>--}}
{{--                    <p class="mb-3 text-muted">Approx is a high quality web applications.</p>--}}
{{--                    <a href="javascript: void(0);" class="btn text-primary shadow-sm rounded-pill">Upgrade your plan</a>--}}
{{--                </div>--}}
            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
<div class="startbar-overlay d-print-none"></div>
