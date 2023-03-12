<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                         src="{{ asset('assets/admin/img/faces/5.jpg')}}">
                    <span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">ADMIN</h4>
                    <span class="mb-0 text-muted">Admin</span>
                </div>
            </div>
        </div>
        <br><br>
        <ul class="side-menu">
            <li class="side-item side-item-category">Dashboard</li>
            <li class="slide">
                <a class="side-menu__item" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon side-menu__icon" height="24"
                         viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <span class="side-menu__label">Home</span>
                    <span class="badge badge-success side-badge"></span>
                </a>
            </li>
            <li class="side-item side-item-category">Trips</li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon side-menu__icon" height="24"
                         viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                    <span class="side-menu__label">Trips</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('trips.index') }}">All</a></li>
                    <li><a class="slide-item" href="{{ route('trips.create') }}">create new</a></li>
                </ul>
            </li>

            <li class="side-item side-item-category">Courses</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon side-menu__icon" height="24"
                         viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                    <span class="side-menu__label">Coures</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
{{--                    <li><a class="slide-item" href="{{ route('courses.index') }}">All</a></li>--}}
{{--                    <li><a class="slide-item" href="{{ route('courses.create') }}">create new</a></li>--}}
{{--                    <li><a class="slide-item" href="{{ route('courses.trashed') }}">Deleted only</a></li>--}}

                </ul>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
