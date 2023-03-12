@extends('layouts.dashboard')

@section('links')
    <h4 class="content-title mb-0 my-auto">Home</h4>
    <h4 class="content-title mb-0 my-auto">/ Trips</h4>
    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ create</span>
@endsection

@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">

                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Create New Trip</h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Our Courses Description Info</p>
                </div>

                <div class="card-body offset-2">
                    <form class="form" action="{{ route('trips.store') }}" method="POST">
                        @csrf

                        <div class="form-body">
                            <h4 class="form-section">
                                <i class="fa fa-home"></i>
                                Trip Info
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bus_id">Bus</label>
                                        <select class="form-control" name="bus_id" id="bus_id">
                                            <option value="" disabled selected>Select a bus</option>
                                            @foreach ($buses as $id => $plate_number)
                                                <option value="{{ $id }}">{{ $plate_number }}</option>
                                            @endforeach
                                        </select>
                                        @error("bus_id")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="line">Trip Line</label>
                                        <input type="hidden" name="line[]" id="line">
                                        <select class="form-control" name="line_data" id="line_data" multiple>
                                            <option value="" disabled selected>Select a to stations</option>
                                            @foreach ($stations as $station)
                                                <option value="{{ $station->code }}">{{ $station->name }}</option>
                                            @endforeach
                                        </select>

                                        @error("line.*")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-1">
                                        <input type="checkbox" value="1"
                                               name="status"
                                               id="status"
                                               class="check-box" data-color="success"/>
                                        <label for="status" class="card-title ml-1">Active</label>
                                        @error("status")
                                        <span class="text-danger"> </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-actions offset-2">
                            <button type="button" class="btn btn-warning mr-1"
                                    onclick="history.back();">
                                <i class="ft-x"></i> back
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /row -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change', '#line_data', function () {
                let data = $(this).val();
                let lines = $('#line').val();
                var difference = $(data).not(line).get();
                lines =
                console.log(difference);
                console.log(lines);
            })
        })
    </script>
@endsection
