<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="full-url" content="{{ URL('') }}">
    <meta name="language" content="{{ app()->getLocale() }}">
    <title>
        Bus Booking System -
        @if(View::hasSection('title'))
            @yield('title')
        @else
            Dashboard
        @endif
    </title>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/admin/img/brand/favicon.png')}}" type="image/x-icon"/>
    @yield('styles')
    <!-- Icons css -->
    <link href="{{asset('assets/admin/css/icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/closed-sidemenu.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <script src="{{ asset('assets/admin/js/notify.js') }}"></script>

</head>
<body class="main-body app sidebar-mini">
<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/admin/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- main-content -->
<div class="main-content app-content">
    @include('dashboard.includes.sidebar')

    @include('dashboard.includes.header')
    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    @yield('links')
                </div>
            </div>

            <div class="d-flex my-xl-auto right-content">
                <div class="mb-3 mb-xl-0">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary">
                            {{ \Carbon\Carbon::now()->timezone('Africa/Cairo')->isoFormat('dddd, MMMM Do YYYY, h:mm') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        @include('dashboard.includes.alerts.success')
        @include('dashboard.includes.alerts.errors')

        @yield('content')
    </div>
</div>
@include('dashboard.includes.footer')

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>


<!-- JQuery min js -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{asset('assets/admin/plugins/ionicons/ionicons.js')}}"></script>
<!-- Rating js-->
<script src="{{asset('assets/admin/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('assets/admin/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{asset('assets/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{asset('assets/admin/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Custom Scroll bar Js-->
<script src="{{asset('assets/admin/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{asset('assets/admin/js/eva-icons.min.js')}}"></script>
<!-- Sticky js -->
<script src="{{asset('assets/admin/js/sticky.js')}}"></script>
<script src="{{ asset('assets/admin/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

@yield('vendor')

<!-- custom js -->
<script src="{{asset('assets/admin/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{asset('assets/admin/plugins/side-menu/sidemenu.js')}}"></script>
<!-- END: Page JS-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'LANGUAGE': $('meta[name="language"]').attr('content'),
        },
    });
    let dashboardRequest = window.dashboardRequest = {
        fullURL: $("meta[name='full-url']").attr('content'),
        URL: function (path = '/') {
            return this.fullURL + path
        },
        makeRequest(type, url, param, callback) {
            let ajaxParameters = {};
            ajaxParameters.type = type;
            ajaxParameters.url = (url.indexOf(this.fullURL) == -1) ? this.URL(url) : url;
            if (typeof param != "function") {
                ajaxParameters.data = param;
            }
            ajaxParameters.success = function (msg) {
                (typeof param == "function") ? param(msg) : callback(msg)
            };
            $.ajax(ajaxParameters);
        },
        get: function (url, param, callback) {
            this.makeRequest('GET', url, param, callback);
        },
        post: function (url, param, callback) {
            param._token = $("meta[name='csrf-token']").attr('content');
            // let formData = new FormData(param);
            // let files = $('input[type="file"]');
            // $.each(files, function () {
            //     formData.append(this.name, this);
            // });
            this.makeRequest('POST', url, param, callback);
        },
        addCommas: function (nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            let rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        },
        stringLimit: function (string, limit = 90) {
            return string.substring(0, limit) + (string.length > limit ? '....' : '')
        },
        generatePaginationHtml: function (meta) {
            html = '';
            links = meta.links
            if (links.length > 3) {
                links.forEach(function (item) {
                    if (item.label == '&laquo; Previous') {
                        item.label = '&laquo;';
                        page = meta.current_page - 1
                    } else if (item.label == 'Next &raquo;') {
                        item.label = '&raquo;';
                        page = meta.current_page + 1
                    } else {
                        page = item.label
                    }
                    html += '<li class="page-item ' + (item.url == null ? 'disabled' : '') + ' ' + (item.active ? 'active' : '') + '"><a data-url="' + item.url + '" data-page="' + page + '" ' + (item.url == null ? 'disabled="disabled"' : '') + ' class="page-link" href="#">' + item.label + '</a></li>';
                })
            }

            return html;
        },
        getErrorMessageHtml(message) {
            if (typeof message == 'object') {
                let html = '<div class="alert alert-danger"><ul>';
                for (let key in message) {
                    html += '<li>' + message[key] + '</li>';
                }
                html += '</ul></div>';
                console.log(html)
                return html;
            }
            return '<div class="alert alert-danger">' + message + '</div>';
        },
        getSuccessMessageHtml(message) {
            if (typeof message == 'object') {
                let html = '<div class="alert alert-success"><ul>';
                for (let key in message) {
                    html += '<li>' + message[key] + '</li>';
                }
                html += '</ul></div>';
                return html;
            }
            return '<div class="alert alert-success">' + message + '</div>';
        },
    };
</script>
<!-- END: Theme JS-->
@yield('scripts')
<script>
    $(document).ready(function () {
        $(document).on('click', '.deleteBtn', function (event) {
            event.preventDefault();
            const url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You can not get this data after deletion!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete!',
                cancelButtonText: 'Cancel',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    window.location.href = url;
                    console.log(url)
                }
            });
        })
        $(document).on('click', '.editBtn', function (event) {
            event.preventDefault();
            const url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you need to edit this data really?!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dd9333',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Edit!',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonClass: 'btn btn-warning ml-1',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    window.location.href = url;
                    console.log(url)
                }
            });
        })
    });
</script>
</body>
</html>
