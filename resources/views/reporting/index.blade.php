@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">From</span>
                            <input type="date" class="form-control" placeholder="Username" name="from" value="{{$from}}" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="date" class="form-control" placeholder="Username" name="to" value="{{$to}}" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Status</span>
                            <select name="status" class="form-control">
                                <option value="all">All</option>
                                <option value="pending" @selected($status == "pending")>Pending</option>
                                <option value="completed" @selected($status == "completed")>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                       <input type="submit" value="Filter" class="btn btn-success w-100">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Reporting</h3>
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
                            <th>Lab ID</th>
                            <th>Patient</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Entered on</th>
                            <th>Entered By</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $key => $receipt)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $receipt->id }}</td>
                                    <td><a href="{{route('reporting.tests.index', $receipt->id)}}" class="text-info">{{ $receipt->patient_name }}</a></td>
                                    <td>{{ $receipt->patient_gender }}</td>
                                    <td>{{ $receipt->patient_contact }}</td>
                                    <td>{{ date("d-m-Y", strtotime($receipt->entery_time)) }} {{ \Carbon\Carbon::parse($receipt->entery_time)->format('h:i A') }}</td>
                                    <td>{{ $receipt->user->name }}</td>
                                    <td>{{ $receipt->status }}</td>
                                    <td class="text-end">{{ number_format($receipt->net_amount) }}</td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8" class="text-end">Total</th>
                                <th  class="text-end">{{number_format($receipts->sum('net_amount'))}}</th>
                            </tr>
                        </tfoot>
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
