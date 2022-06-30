@extends("backend.layouts.master")

@section("page-css")
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
@endsection

@section("content")
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{auth()->user()->name}}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Overview Section -->
            <div class="row">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection

@section("page-script")
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });

    </script>
@endsection
