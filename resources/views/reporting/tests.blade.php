@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
           
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Reporting - {{$receipt->id}} | {{$receipt->patient_name}} | {{$receipt->patient_age}} | {{$receipt->patient_gender}}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Test</th>
                            <th>Report Entered By</th>
                            <th>Report Entered On</th>
                            <th>Report Status</th>
                        </thead>
                        <tbody>
                            @foreach ($tests as $key => $test)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ route('reporting.tests.parameters', ['id' => $test->id]) }}">{{ $test->test->name }}</a></td>
                                    <td>{{ $test->result_entered_by ? $test->user->name : null }}</td>
                                    <td>{{ $test->result_entered_at ? date("d-m-Y", strtotime($test->result_entered_at)) : null }} {{  $test->result_entered_at ? \Carbon\Carbon::parse($test->result_entered_at)->format('h:i A') : null }}</td>
                                    <td>{{ $test->status() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
