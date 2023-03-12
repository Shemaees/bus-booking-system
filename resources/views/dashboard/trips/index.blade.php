@extends('layouts.dashboard')

@section('styles')
    <!-- Internal Data table css -->
    <link href="{{asset('assets/admin/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <style>
        .label__checkbox {
            display: none;
        }
        .label__check {
            border-radius: 50%;
            border: 5px solid rgba(0, 0, 0, 0.1);
            background: white;
            vertical-align: middle;
            margin-right: 7px;
            width: 2em;
            height: 2em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border .3s ease;

        i.icon {
            opacity: 0.2;
            font-size: ~ 'calc(1rem + 1vw)';
            color: transparent;
            transition: opacity .3s .1s ease;
            -webkit-text-stroke: 3px rgba(0, 0, 0, .5);
        }

        &
        :hover {
            border: 5px solid rgba(0, 0, 0, 0.2);
        }

        }

        .label__checkbox:checked + .label__text .label__check {
            animation: check .5s cubic-bezier(0.895, 0.030, 0.685, 0.220) forwards;

        .icon {
            opacity: 1;
            transform: scale(0);
            color: white;
            -webkit-text-stroke: 0;
            animation: icon .3s cubic-bezier(1.000, 0.008, 0.565, 1.650) .1s 1 forwards;
        }

        }

        @keyframes icon {
            from {
                opacity: 0;
                transform: scale(0.3);
            }
            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        @keyframes check {
            0% {
                width: 1.5em;
                height: 1.5em;
                border-width: 5px;
            }
            10% {
                width: 1.5em;
                height: 1.5em;
                opacity: 0.1;
                background: rgba(0, 0, 0, 0.2);
                border-width: 15px;
            }
            12% {
                width: 1.5em;
                height: 1.5em;
                opacity: 0.4;
                background: rgba(0, 0, 0, 0.1);
                border-width: 0;
            }
            50% {
                width: 2em;
                height: 2em;
                background: #00d478;
                border: 0;
                opacity: 0.6;
            }
            100% {
                width: 2em;
                height: 2em;
                background: #00d478;
                border: 0;
                opacity: 1;
            }
        }
    </style>

@endsection

@section('links')
    <h4 class="content-title mb-0 my-auto">Home</h4>
    <h4 class="content-title mb-0 my-auto">/ Categories</h4>
    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Courses</span>
@endsection

@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">

                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Recently Courses Table</h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Our Courses Description Info</p>
                </div>

                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table id="categories-table" class="table courses-table" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Bus</th>
                                <th>Line</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($trips as $trip)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trip->bus->plate_number }}</td>
                                    <td>
                                        <label class="btn btn-info-gradient btn-sm">
                                            {{ $trip->trip_line_text }}
                                        </label>
                                    </td>
{{--                                    <td>--}}
{{--                                        <a class="btn btn-warning btn-sm" href="{{ route('trips.edit', $trip->id) }}" title="Edit">--}}
{{--                                            <i class="fa fa-edit"></i>--}}
{{--                                        </a>--}}

{{--                                        <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Are you sure?')"--}}
{{--                                              style="display: inline-block;">--}}
{{--                                            @csrf--}}
{{--                                            <input type="hidden" name="_method" value="DELETE">--}}
{{--                                            <button type="submit" class="btn btn-danger btn-sm">--}}
{{--                                                <i class="fa fa-trash"></i>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /row -->
@endsection

@section('scripts')
    <!-- Internal Data tables -->
    <script src="{{asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{asset('assets/admin/js/table-data.js')}}"></script>
    <script>
        $(function () {
            let excelButtonTrans = 'excel'
            let pdfButtonTrans = 'pdf'
            let printButtonTrans = 'print'

            let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
                'ar': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {className: 'btn'})
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages['{{ app()->getLocale() }}']
                },
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 10,
                dom: 'lBfrtip<"actions">',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-outline-success btn-sm-width box-shadow-3 mb-1',
                        text: excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-outline-success btn-sm-width box-shadow-3 mb-1',
                        text: pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-outline-success btn-sm-width box-shadow-3 mb-1',
                        text: printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });
            $('.courses-table:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });
    </script>

@endsection
